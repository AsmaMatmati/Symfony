<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Medicament;
use App\Entity\Ordonnance;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdonnanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

$builder
    ->add('Medecin')

    //->add('Medecin',EntityType::class,['class'=>Medecin::class,'choice_label'=>'nomMedecin'])
   // ->add('Medecin',EntityType::class,['class'=>Medecin::class,'choice_label'=>'prenomMed'])
   // ->add('Medecin',EntityType::class,['class'=>Medecin::class,'choice_label'=>'NumTel'])

    ->add('Patient',EntityType::class,['class'=>Patient::class,'choice_label'=>'nom'])
    ->add('Patient',EntityType::class,['class'=>Patient::class,'choice_label'=>'prenom'])


    ->add('Consultation')

//->add('Medicaments')
    ->add('Medicaments',EntityType::class,['class'=>Medicament::class,'choice_label'=>'name'])


            ->add('description')
            ->add('nbr_jrs')
            ->add('nbr_doses')
            ->add('nbr_fois')


        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ordonnance::class,
        ]);
    }
}
