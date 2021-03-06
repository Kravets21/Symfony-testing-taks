<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\OrderForm;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Manager\CartManager;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(CartManager $cartManager, Request $request)
    {
	$id = $cartManager->getCurrentCart()->getId();
	$order = $this->getDoctrine()->getRepository(Order::class)->find($id);
	
        $form = $this->createForm(OrderForm::class, $order);
		
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
	    $order = $form->getData();

	    $entityManager = $this->getDoctrine()->getManager();
	    $entityManager->persist($order);
	    $entityManager->flush();
	    return $this->redirectToRoute('home');
        }
	
	return $this->render(
		'home/add.twig',
		array('form' => $form->createView()));
    }
}
