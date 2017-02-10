<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCriteria;


class SurveyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('commentairesClient')
        //->add('signatureClient')
        ->add('signatureClient', HiddenType::class)
        ->add('collaborateur', EntityType::class, array(
              'class' => 'AppBundle:Collaborateur',
              'required'    => false,
              'choice_label' => 'firstname',
            ))       
        ->add("surveys", CollectionType::class, array(
                'entry_type' => SurveyCriteriaType::class,
                'allow_add'    => true,
                'label' => ''   
           
        ))
         ;


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Survey::class,
        ));
        
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_survey';
    }


}
