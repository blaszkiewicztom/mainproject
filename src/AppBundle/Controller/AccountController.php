<?php

namespace AppBundle\Controller;

use AppBundle\Form\ChangePassForm;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AccountController extends Controller
{
    /**
     * @Route("/account", name="account")
     */
    public function accountInfoAction(Request $request, UserPasswordEncoderInterface $encoder, EntityManager $em){

        $templating = $this->container->get('templating');

        $form = $this->createForm(ChangePassForm::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $formData = $form->getData();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $encodedPass = $encoder->encodePassword($user, $formData->getNewPassword());

            $user->setPassword($encodedPass);
            $em->persist($user);
            $em->flush();

            $this->addFlash('change_pass_success', 'Hasło zostało pomyślnie zmienione');
            return $this->redirectToRoute('account');
        }

        $content = $templating->render('project/account.html.twig', array(
            'change_pass_form' => $form->createView(),
        ));

        return new Response($content);
    }
}
