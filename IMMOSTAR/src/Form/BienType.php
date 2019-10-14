<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Type;


class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb_piece',NumberType::class, array('label' => 'Nb_Piece : ','attr'=> array('class' => 'form-control')))
            ->add('nb_chambre',NumberType::class, array('label' => 'Nb_Chambre : ','attr'=> array('class' => 'form-control')))
            ->add('superficie',NumberType::class, array('label' => 'Superficie : ','attr'=> array('class' => 'form-control')))
            ->add('prix',NumberType::class, array('label' => 'Prix : ','attr'=> array('class' => 'form-control')))
            ->add('chauffage',TextType::class, array('label' => 'Chauffade : : ','attr'=> array('class' => 'form-control')))
            ->add('annee',NumberType::class,array('label' => 'Année : ','attr'=> array('class' => 'form-control')))
            ->add('localisation',TextType::class, array('label' => 'Localisation : : ','attr'=> array('class' => 'form-control')))
            ->add('etat',TextType::class, array('label' => 'Etat : : ','attr'=> array('class' => 'form-control')))
            ->add('type',EntityType::class, array('class' => Type::class,'choice_label'  => 'libelle','multiple'=>false,'required'=>true,'placeholder'=>'---Choisie une Type---'))
            
            ->add('valider',SubmitType::class, array('label' => 'Valider','attr'=> array('class' => 'btn btn-primary btn-block')))
            ->add('annuler',ResetType::class, array('label' => 'Quitter','attr'=> array('class' => 'btn btn-primary btn-block')))
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
