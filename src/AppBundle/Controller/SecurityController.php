<?php

namespace AppBundle\Controller;

use AppBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
//        dump($_SESSION);die;

        $error = $authUtils->getLastAuthenticationError();
        $lastUserName = $authUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class, array(
            '_email' => $lastUserName,
        ));


        $templating = $this->container->get('templating');
        $content = $templating->render('project/login.html.twig', array(
            'login_form' => $form->createView(),
            'error' => $error
        ));

        return new Response($content);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logOutAction(){
        throw new \Exception('Nastąpiło wylogowanie');
    }
}
