<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('zip_code')
            ->add('city')
            ->add('codeSX')
            ->add('user', EntityType::class, array(
                'class' => 'UserBundle:User',
                'required'    => false,
                'choice_label' => 'username',
            ))

        ;
    }
}