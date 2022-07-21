<?php

namespace App\Form;

use App\Entity\Rate;
use App\Entity\Cat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('catId', EntityType::class, [
                'class' => Cat::class,
                'label' => 'Which cat is your rate for?',
                'choice_label' => 'name',
                'label_attr' => [
                    'class' => 'fs-4'
                ],
            ])
            ->add('rate', ChoiceType::class, [
                'label' => 'Choose your rate!',
                'label_attr' => [
                    'class' => 'fs-4'
                ],
                'choices'  => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rate::class,
        ]);
    }
}
