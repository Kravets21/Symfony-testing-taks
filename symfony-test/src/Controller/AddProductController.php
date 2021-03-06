<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProductForm;
use App\Entity\Product;

class AddProductController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function index(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductForm::class, $product);
		
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
	    $product = $form->getData();

	    $entityManager = $this->getDoctrine()->getManager();
	    $entityManager->persist($product);
	    $entityManager->flush();
	    return $this->redirectToRoute('home');
        }
	
	return $this->render(
		'home/add.twig',
		array('form' => $form->createView()));
    }
}
