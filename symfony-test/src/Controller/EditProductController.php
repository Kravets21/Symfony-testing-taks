<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProductForm;
use App\Entity\Product;
use App\Form\EditForm;

class EditProductController extends AbstractController
{
    /**
     * @Route("/edit{id}", name="edit")
     * Method({"GET", "POST"})
     */
    public function index(Request $request, $id) {
	
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $form = $this->createForm(ProductForm::class, $product);
		
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
	    
	    $entityManager = $this->getDoctrine()->getManager();
	    $entityManager->flush();
	    return $this->redirectToRoute('home');
        }
	
	return $this->render(
		'/home/edit.twig',
		array('form' => $form->createView()));
    }
}
