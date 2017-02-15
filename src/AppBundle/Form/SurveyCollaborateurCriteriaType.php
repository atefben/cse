<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SurveyCollaborateurCriteriaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->criteriaType = $options['criteriaType'];

        $builder
        ->add('criteria', EntityType::class, array(
              'class' => 'AppBundle:Criteria',
              'query_builder' => function ($er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.criteriaType = :criteriaType')
                        ->setParameter("criteriaType", $this->criteriaType)
                        ;
                },
              'required'    => false,
              'choice_label' => 'label',
              'attr'   =>  array(
                'class'   => 'form-control')
            )
            )

        ->add('score', ChoiceType::class, array(
            'attr'   =>  array(
                'class'   => 'form-control score')
            ,
                'choices'  => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10
                ),
            ))
        ->add('coefficient', ChoiceType::class, array(
            'attr'   =>  array(
                'class'   => 'form-control coefficient')
            ,
                'choices'  => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5
                    
                ),
            ))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SurveyCollaborateurCriteria',
            'criteriaType'=> null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_surveycriteria';
    }


}
