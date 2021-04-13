<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Chambre;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num',TextareaType::class,['attr'=>['placeholder'=>"num chambre"]])
            ->add('numetage', TextareaType::class,['attr'=>['placeholder'=>"num etage"]])
            ->add('nbrplace', TextareaType::class,['attr'=>['placeholder'=>"nombre de place"]])
            ->add('service',TextareaType::class,['attr'=>['placeholder'=>"nom du service"]])
            ->add('bloc',TextareaType::class,['attr'=>['placeholder'=>"nom du bloc"]])
            ->add('category',EntityType::class,['class'=>Category::class,'choice_label'=>'nom'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
