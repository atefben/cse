<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCriteria;


class SurveyType extends AbstractType
{

    /**
     * @var mixed userID
     */
    private $userID;

    /**
     * @var mixed $customerID
     */
    private $customerID;

    /**
     * @var mixed $criteriaType
     */
    private $criteriaType;


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
 
        $this->userID = $options['user'];
        $this->customerID = $options['customer'];
        $this->criteriaType = $options['criteriaType'];

        $builder
            ->add('commentairesClient')
            ->add('user', EntityType::class, array(
                    'class'         => 'UserBundle\Entity\User',
                    'required'      => true,
                    'choice_label'  => 'firstname',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.id = :userID')
                            ->setParameter("userID", $this->userID)
                            ;
                    }
                )
            )
            ->add('customer', EntityType::class, array(
                    'class'         => 'AppBundle\Entity\Customer',
                    'required'      => true,
                    'choice_label'  => 'name',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->where('c.id = :customerID')
                            ->setParameter("customerID", $this->customerID)
                            ;
                    }
                )
            )
            ->add('signatureClient', HiddenType::class)
            ->add('collaborateur', EntityType::class, array(

                'class'         => 'AppBundle:Collaborateur',
                'required'      => true,
                'choice_label'  => 'firstname',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.customer = :customerID')
                        ->setParameter("customerID", $this->userID)
                    ;
                }
            ))
            ->add("surveys", CollectionType::class, array(
                'entry_type'    => SurveyCriteriaType::class,
                'allow_add'     => true,
                'label'         => '',
                'entry_options' => array(
                    'criteriaType' => $this->criteriaType
                    )
                )
            )
        ;


    }

    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => Survey::class,
            'user'              => null,
            'customer'          => null,
            'collaborateur'     => null,
            'criteriaType'      => null
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
