<?php

namespace AppBundle\Controller;


use AppBundle\Form\SendMessageForm;
use AppBundle\Services\HistoryOfMessagesGenerator;
use AppBundle\ViewClass\Recipients;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MessagesController extends Controller
{
    /**
     * @Route("/messages", name="messages")
     *
     */
    public function indexAction(EntityManager $em, Request $request)
    {
        //handling send message form
        if($request->getMethod()==='POST') {
            $sendMessageForm = $this->createForm(SendMessageForm::class);
            $sendMessageForm->handleRequest($request);
            if ($sendMessageForm->isSubmitted() && $sendMessageForm->isValid()) {
                $message = $sendMessageForm->getData();
                $recipientId = $request->request->get('app_bundle_send_message_form')['submit'];
                $recipient = $em->getRepository('AppBundle:User')
                                    ->findOneBy(array(
                                        'id' => $recipientId
                                    ));
                $message->setUser($recipient);
                $message->setSender($this->getUser());

                $em->persist($message);
                $em->flush();

                $this->addFlash('message_sent_success',
                    'Wiadomość została dostarczona użytkownikowi: ' . $recipient->getEmail());

            }
        }


        $templating = $this->get('templating');

        $content = $templating->render('project/messages.html.twig', array());

        return new Response($content);
    }

    /**
     * @Route("/messages/send", name="send_message")
     * @Method("POST")
     */
    public function sendMessageAction(Request $request){



        $sendMessageTemplating = $this->get('templating')->render('project/ajax/send_message.html.twig');

//        if($request->request->get('name')){
            $response = array(
                'output' => $sendMessageTemplating
            );
            return new JsonResponse($response);
//        }

//        return new Response('Coś poszło nietak');

    }
    /**
     * @Route("/messages/send/load_form", name="load_send_message_form")
     * @Method("POST")
     */
    public function loadSendMessageForm(Request $request){

        // odebranie info do kogo ma być wiadomość

        $submitValue = $request->request->get('submit_value');
        // przygotowanie odpowiedniego formularza

        $sendMessageForm = $this->createForm(SendMessageForm::class,null, array(
            'submit_value' => $submitValue
        ));

        $templating = $this->get('templating')->render('project/ajax/send_message_form.html.twig', array(
            'sendMessageForm' => $sendMessageForm->createView()
        ));

        $response = array(
            'output' => $templating
        );

        return new JsonResponse($response);

    }
    /**
     * @Route("/messages/load_history_of_messages", name="load_history_of_messages")
     * @Method("POST")
     */
    public function loadHistoryOfMessages(){

        $user = $this->getUser();

        // getting all messages for user
        $historyOfMessagesRepo = $this->getDoctrine()->getRepository('AppBundle:Message');
        $result = $historyOfMessagesRepo->findAllMessagesForUser($user->getId());
        if(!$result){
            return new Response('<div class="alert alert-info">Brak zawartości do wyświetlenia</div>');
        }

        $recipients = new Recipients($result);
        $recipients->setRecipients();
        $recipients->removeOwnerId($user->getId());

        $generator = new HistoryOfMessagesGenerator($recipients->getRecipients(), $result);
        $historyOfMessages = $generator->generate();


        $templating = $this->get('templating')->render(':project/ajax:history_of_messages.html.twig', array(
            'historyOfMessages' => $historyOfMessages
        ));

        return new Response($templating);
    }
    /**
     * @Route("/messages/load_system_messages", name="load_system_messages")
     * @Method("POST")
     */
    public function loadSystemMessages(){

        $templating = $this->get('templating')->render('project/ajax/system_messages.html.twig');

        return new Response($templating);

    }
}
