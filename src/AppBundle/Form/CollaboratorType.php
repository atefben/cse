<?php
/**
 * Created by PhpStorm.
 * User: thibaut
 * Date: 03/03/2017
 * Time: 15:13
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CollaboratorType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('phone')
            ->add('code')
            ->add('userManager', EntityType::class, array(
                'class' => 'UserBundle:User',
                'required'    => false,
                'choice_label' => 'username',
            ))

        ;
    }
}