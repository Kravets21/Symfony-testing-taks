<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="orderRef", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $items;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $buyer_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adress;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;
    
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
    
    /**
     * @return Collection|OrderItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }
    
    public function addItem(OrderItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setOrderRef($this);
        }

        return $this;
    }
    
    public function removeItem(OrderItem $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getOrderRef() === $this) {
                $item->setOrderRef(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuyerName(): ?string
    {
        return $this->buyer_name;
    }

    public function setBuyerName(string $buyer_name): self
    {
        $this->buyer_name = $buyer_name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
