<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('username')
            ->add('plainPassword')
            ->add('enabled', HiddenType::class, array('data' => true ))
            ->add('userReponsable', EntityType::class, array(
              'class' => 'UserBundle:User',
              'required'    => false,
              'choice_label' => 'username',
            ))

           ->add('roles',  CollectionType::class, array(
               'entry_type'   => ChoiceType::class,
               'entry_options'  => array(
                   'label' => false,
                   'choices'  => array(
                       'Administrateur' => 'ROLE_ADMIN',
                       'Responsable'     => 'ROLE_RESPONSABLE_AGENCE',
                       'Commercial'    => 'ROLE_COMMERCIAL',
                   ),
               ),
           ))
        ;
    }
}