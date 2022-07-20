<?php

namespace App\Form;

use Vich\UploaderBundle\Form\Type\VichFileType;
use App\Entity\CatPicture;
use App\Entity\Cat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatPictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture')
            ->add('pictureFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
        ])
            ->add('mainPicture')
            ->add('cat', EntityType::class, [
                'class' => Cat::class,
                'label' => 'Chat',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'cat-names'
                ],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CatPicture::class,
        ]);
    }
}
