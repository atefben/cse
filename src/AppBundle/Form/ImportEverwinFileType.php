<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 07/02/17
 * Time: 14:03
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class ImportEverwinFileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file_to_import',FileType::class, array('label' => 'Fichier CSV Everwin à importer'));
    }



    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_import_everwin_file';

    }
}