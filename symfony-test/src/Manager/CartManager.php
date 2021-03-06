<?php

namespace App\Manager;

use App\Entity\Order;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;

class CartManager
{
    private $cartSessionStorage;

    private $entityManager;

    public function __construct(
        CartSessionStorage $cartStorage,
        EntityManagerInterface $entityManager
    ) {
        $this->cartSessionStorage = $cartStorage;
        $this->entityManager = $entityManager;
    }

    public function getCurrentCart(): Order
    {
        $cart = $this->cartSessionStorage->getCart();

        if (!$cart) {
            $cart = Order::createOrder();
        }

        return $cart;
    }

    public function save(Order $cart): void
    {
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        $this->cartSessionStorage->setCart($cart);
    }
    
}
