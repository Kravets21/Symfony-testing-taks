<?php

namespace App\Controller;

use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\OrderItem;
use App\Entity\Order;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartManager $cartManager)
    {
        $cart = $cartManager->getCurrentCart();
	
        return $this->render('cart/index.twig', [
            'cart' => $cart
        ]);
    }
    
    /**
     * @Route("/delete{id}", name="delete")
     */
    public function remove(OrderItem $item, CartManager $cartManager)
    {
	$cart = $cartManager->getCurrentCart();
	$cart->removeItem($item);
	$cartManager->save($cart);    
	
	return $this->redirectToRoute('cart');
    }
}