<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Product;

class ProductForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
	$builder
	    ->add('name', TextType::class, array('attr' => array('class' => 'form-input')))
	    ->add('price', TextType::class, array('attr' => array('class' => 'form-input')))
	    ->add('save', SubmitType::class, array(
	      'label' => 'Create',
	      'attr' => array('class' => 'create-button')
	    ))
	    ->getForm();
    }
    
}
