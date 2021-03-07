<?php

namespace App\Form;

use App\Entity\Medicament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class MedicamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextareaType::class,['attr'=>['placeholder'=>"Nom Médicament"]])
            ->add('code',TextareaType::class,['attr'=>['placeholder'=>"Code Médicament"]])
            ->add('prix',TextareaType::class,['attr'=>['placeholder'=>"Prix Médicament"]])
            ->add('stock',TextareaType::class,['attr'=>['placeholder'=>"Stock Médicament"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
        ]);
    }
}
