<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 28.09.2017
 * Time: 15:23
 */

namespace AppBundle\Security;


use AppBundle\Entity\User;
use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    private $formFactory;
    private $em;
    private $user;
    private $encoder;
    private $router;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, UserPasswordEncoderInterface $encoder, Router $router)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->encoder = $encoder;
        $this->router = $router;
    }



    public function getCredentials(Request $request)
    {
        //należy sprawdzić czy żądanie pochodzi z formularza logowania i czy zostało wysłane metodą POST
        $isSubmitted = $request->getPathInfo() == '/login' && $request->isMethod('POST');
        // jeśli nie jest, metoda zwróci wartość null i dalszy proces autentykacji zostanie pominięty
        if(!$isSubmitted){
            return;
        }
        // należy przechwycić wpisane credentials z formularza (aby stworzyć formularz w tej klasie należy zastosować dependency injection
        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);
        $data = $form->getData();

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $email = $credentials['_email'];

        $user = $this->em->getRepository('AppBundle:User')
                        ->findOneBy(array(
                            'email' => $email
                        ));
        if($user === null){
            return null;
        }
        $this->user = $user;
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $inputPassword = $credentials['_password'];
        $isPasswordValid = $this->encoder->isPasswordValid($this->user, $inputPassword);

        if($isPasswordValid){
            return true;
        }
        return false;

    }

    protected function getLoginUrl()
    {
        return $this->router->generate('login');
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $url = $this->router->generate('account');
        return new RedirectResponse($url);
    }

}