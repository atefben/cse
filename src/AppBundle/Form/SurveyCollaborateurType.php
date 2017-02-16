<?php

namespace AppBundle\Form;

use AppBundle\Entity\SurveyCollaborateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCriteria;


class SurveyCollaborateurType extends AbstractType
{



    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
 
        $this->id = $options['idUser'];
        $this->criteriaType = $options['criteriaType'];
        $builder
        ->add('commentairesCollaborateur')
        ->add('signatureCollaborateur', HiddenType::class)
        ->add('customer', EntityType::class, array(
              'class' => 'AppBundle:Customer',
               'required'    => false,
              'choice_label' => 'name',
              'query_builder' => function ($er) {
                  return $er->createQueryBuilder('c')
                    ->where('c.user = :idUser')
                    ->setParameter("idUser", $this->id)
                  ;
               }))
             
              
        ->add("surveysCollaborateur", CollectionType::class, array(
                'entry_type' => SurveyCollaborateurCriteriaType::class,
                'allow_add'    => true,
                'label' => '',
                'entry_options' => array(
                    'criteriaType' => $this->criteriaType
                )

        ))
         ;


    }

    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SurveyCollaborateur::class,
            'idUser' => null,
            'criteriaType'=> null
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
