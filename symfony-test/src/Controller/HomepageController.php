<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Product;
use App\Form\ProductForm;

class HomepageController extends AbstractController // тут в идеале надо сделать меньше кода в контроллере, а то большой получится, но пока не успел нормалоно сделать
{
    /**
     * @Route("/", name="home")
     */
    public function homepage(Request $request)
    {
	$products = $this->getDoctrine()->getRepository(Product::class)->findAll();
	
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
		'home/home.twig',
		array('products' => $products,
		      'form' => $form->createView()));
    }
     
    /**
     * @Route("/edit{id}", name="edit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
	
	$product = new Product();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $form = $this->createFormBuilder($product)
	    ->add('name', TextType::class, array('attr' => array('class' => 'form-input')))
	    ->add('price', TextType::class, array('attr' => array('class' => 'form-input')))
	    ->add('save', SubmitType::class, array(
	      'label' => 'Update',
	      'attr' => array('class' => 'create-button')
	    ))
	    ->getForm();
		
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
