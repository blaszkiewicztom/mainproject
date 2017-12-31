<?php

namespace AppBundle\Controller;


use AppBundle\Entity\AwaitingApprovalProduct;
use AppBundle\Form\NewSaleForm;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends Controller
{
    /**
     * @Route("/sale", name="sale")
     */
    public function saleAction(Request $request, EntityManager $em){

        $newSaleForm = $this->createForm(NewSaleForm::class);

        if($request->getMethod() === 'POST'){
            $newSaleForm->handleRequest($request);
            if($newSaleForm->isSubmitted() && $newSaleForm->isValid()){

                $user = $this->getUser();

                $product = $newSaleForm->getData();
                $product->setCreatedAt(new \DateTime('now'));
                $product->setUser($user);
//                need to add the product as a awaiting approval by admin
                $awatingProduct = new AwaitingApprovalProduct();
                $awatingProduct->setProduct($product)->setUser($user);

                $em->persist($product);
                $em->persist($awatingProduct);
                $em->flush();

                $this->addFlash('add_product_success', 'Produkt został dodany. Wkrótce zostaniesz poinformowany o utworzeniu aukcji w naszym serwisie.');
                $this->redirectToRoute('sale');
            }
        }

        $templating = $this->get('templating')->render('project/sale.html.twig', array(
            'newSaleForm' => $newSaleForm->createView()
        ));

        return new Response($templating);

    }

}
