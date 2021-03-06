<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Manager\CartManager;
use App\Entity\Product;
use App\Form\ProductForm;
use App\Entity\OrderItem;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homepage()
    {
	$products = $this->getDoctrine()->getRepository(Product::class)->findAll();
	
	return $this->render(
		'home/home.twig',
		array('products' => $products));
    }
    
    /**
     * @Route("/buy{id}", name="addToCart")
     */
    public function addToCart(Product $product, CartManager $cartManager)
    {
            $item = OrderItem::createItem($product);
            $cart = $cartManager->getCurrentCart();
            $cart->addItem($item);

            $cartManager->save($cart);
	    
	return $this->redirectToRoute('home');
    }
     
      
}
