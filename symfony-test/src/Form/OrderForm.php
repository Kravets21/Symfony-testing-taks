<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderForm extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
	$builder
	    ->add('buyer_name', TextType::class, array('attr' => array('class' => 'form-input')))
	    ->add('adress', TextType::class, array('attr' => array('class' => 'form-input')))
	    ->add('phone', TextType::class, array('attr' => array('class' => 'form-input')))
	    ->add('save', SubmitType::class, array(
	      'label' => 'Confirm Order',
	      'attr' => array('class' => 'create-button')
	    ))
	    ->getForm();
    }
}
