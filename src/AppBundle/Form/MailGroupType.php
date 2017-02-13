<?php

namespace AppBundle\Form;

use AppBundle\Entity\MailGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

class MailGroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $users = $usersMailGroup = [];
        $builder->add('label',null,['required'=>true])
//        ->add('users',ChoiceType::class,['attr'=>['class'=>'select2','expanded'=>false,'multiple'=>true]]);
        ->add('users',EntityType::class,
            array(
                'class' => 'UserBundle:User',
                'choice_label' => 'email',
//                'choice_name'=> 'email',
                'multiple' => true,
//                'by_reference' => false,
                'expanded' => false,
                'required' => true,
                'label' => 'Liste de mails'
//                'query_builder' => function(AddresseeRepository $ar) use ($id) {
//                    return $ar->getAllAreNotInThisTheme_QueryBuilder($id);
//                }
            ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MailGroup'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_mailgroup';
    }


}
