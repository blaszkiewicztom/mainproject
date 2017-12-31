<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 21.08.2017
 * Time: 14:22
 */

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\User;
use AppBundle\Form\RegisterForm;
use AppBundle\Services\TextTransformer;
use Nelmio\Alice\Loader\NativeLoader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class HomeController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function homeAction(){
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/../DataFixtures/ORM/fixtures.yml');
        dump($objectSet);die;

    }
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $form = $this->createForm(RegisterForm::class);
        // przechwycenie formularza z requesta
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // pobranie obiektu usera z formularza
            $user = $form->getData();
            // zakodowanie hasła bcryptem
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            //ustawienie na obiekcie zakodowanego hasła
            $user->setPassword($password);

            // zapis danych w bazie
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // utworzenie w tablicy sesyjnej informacji o postępie rejestracji
            $this->addFlash('register_success','Rejestracja przebiegła pomyślnie. Na twój adres e-mail został przesłany link aktywacyjny.');
            $this->addFlash('register_success_info','Ze względów bezpieczeństwa, przeprowadzamy dodatkową weryfikację kont naszych klientów. Pragniemy zapewnić Ci bezpieczne środowisko wymiany towarów. Proces weryfikacji trwa maksymalnie do dwóch dni roboczych. Poinformujemy Cię, gdy otrzymasz pełny dostęp do serwisu.');
            return $this->redirectToRoute('login');
        }

        $templating = $this->container->get('templating');
        $content = $templating->render('project/register.html.twig', array(
            'register_form' => $form->createView()
        ));

        return new Response($content);
    }
    /**
     * @Route("/add", name="add_user")
     */
    public function addUser(Request $request){

        $form = $this->createForm(AddUserForm::class);

        $templating = $this->container->get('templating');
        $page = $templating->render('home/add_user.html.twig', array(
           'form' => $form->createView()
        ));

        // ta metoda wykona się tylko w przypadku, gdy zostanie wykonane zapytanie POST (przy GET ta metoda jest pominięta)
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            dump($form->getData());die;
        }

        return new Response($page);

    }
    /**
     * @Route("/paramconv/show/{company}", name="show_by_company")
     */
    // konwersja parametrów. W roucie podajemy jeden z atrybutów obiektu(zmapowanego przez doctrine), następnie symfony
    // znajdzie nam odpowiedni obiekt z takim parametrem i przyjmie go jako parametr poniższej funkcji
    // wewnątrz funkcji mogę teraz wywoływać odpowiednie metody, bez tworzenia EM oraz obiektu
    public function showByParamConv(User $user){
        $userNip = $user->getNip();
        return new Response($userNip);

        // dependency injection
        // przekazanie serwisu do konstruktora, aby wewnątrz klasy mieć dostęp do metod przekazanego serwisu

        $someDependency = $this->container->get('templating');
        $transformer = new TextTransformer($someDependency);

        echo $transformer->toUpper('jakiś str');
    }
    /**
     *
     * @Route("/home/{user_id}/show", name="show_user_info")
     */
    public function showUser($user_id){
        $em = $this->getDoctrine()->getManager();
        $user_info = $em->getRepository('AppBundle\Entity\User')
            ->findOneBy([
                'id' => $user_id
            ]);
        $templating = $this->container->get('templating');
        $page = $templating->render('home\show_user_info.html.twig',[
           'users' => $user_info
        ]);
        return new Response($page);


    }
    /**
     * @Route("/home/show", name = "show")
     */
    public function showUsers(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle\Entity\User')
            ->findAll();


        $templating = $this->container->get('templating');
        $html = $templating->render('base_for_testing.html.twig', array(
            'users' => $users
        ));
        return new Response($html);

    }
    /**
     * @Route("/home", name="home")
     */
    public function show(){

        $user = new User();

        $user->setEmail('tomalmj@gmail.com');
        $user->setCompany('marianki');
        $user->setPassword('pass');
        $user->setNip(6581114);
        $user->setRegon(65552);

        $userAttr = new UserAttr();
        $userAttr->setCredit(50);
        $userAttr->setIsActive(false);
        $userAttr->setUser($user);


        // pobranie entity managera w celu zarządzania wykonywaniem zapytań
        $em = $this->getDoctrine()->getManager();
        // przygotwanie zapytania
        $em->persist($user);
        $em->persist($userAttr);
        //wykonanie zapytania
        $em->flush();
        return new Response('<html><body>Zapytanie wykonane</body></html>');
        // pobranie templatki z app/resources/vievs
        //$templating = $this->container->get('templating');
        //$html = $templating->render('home/home.html.twig');

        // generowanie odpowiedzi z serwera
        //return new Response($html);
    }
    /**
     * @Route("/home/json", name="show_json_response") // należy nazywać każdy z Route, aby uniknąć później zmian w każdym odnośniku z osobna
     * @Method("GET")
     */
    public function getMostPopularSales(){  // funkcja generująca odpowiedź z serwera w formacie JSON (do wykorzystania np w AJAX)
        $mostPopularSales = [
          ['id' => 1, 'name' => 'aukcja pierwsza', 'description' => 'opis aukcji pierwszej'],
            ['id' => 2, 'name' => 'aukcja druga', 'description' => 'opis aukcji drugiej'],
              ['id' => 3, 'name' => 'aukcja trzecia', 'description' => 'opis aukcji trzeciej'],
        ];
        $data = [
            'mostPopularSales' => $mostPopularSales
        ];

        return new JsonResponse($data);
    }
}