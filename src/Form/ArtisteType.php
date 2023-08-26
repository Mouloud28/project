<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Album;
use App\Entity\Livre;
use App\Entity\Serie;
use App\Entity\Ville;
use App\Entity\Metier;
use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArtisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
            'label' => 'Nom',
            'attr' => [
            'class' => 'input',
            'placeholder' => 'Tapez le nom de l\'artiste.'
            ],
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true
            ])

            ->add('date_naissance', DateType::class, [
            'label' => 'Date de naissance',
            'attr' => ['class' => 'input'],
            'years' => range(0000, date('Y')),
            'attr' => ['class' => 'custom-date-input'],
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true
            ])

            ->add('pays_origine', TextType::class, [
            'label' => 'Pays d\'origine',
            'attr' => [
            'class' => 'input',
            'placeholder' => 'Sélectionnez un pays.'
            ],
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true
            ])

            ->add('ville', EntityType::class, [
            'class' => Ville::class,
            'attr' => ['class' => 'input'],
            'choice_label' => 'nom',
            'label' => 'Ville d\'origine',
            'expanded' => false,
            'placeholder' => 'Sélectionnez une ville.',
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true
            ])

            ->add('imageFile', FileType::class, [
            'label' => 'Photo',
            'attr' => [
            'class' => 'input',
            'enctype' => 'multipart/form-data'],
            'required' => true,
            'row_attr' => ['class' => 'mx-5 my-3'],
            ])
            ->remove('photo')
            
            ->add('metiers', EntityType::class, [
            'class' => Metier::class,
            'choice_label' => 'nom',
            'label' => 'Activité(s)',
            'attr' => ['class' => 'input'],
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez une ou plusieurs activités.',
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true])
            
            ->add('livre', EntityType::class, [
            'class' => Livre::class,
            'choice_label' => 'titre_francais',
            'label' => 'Livre(s)',
            'attr' => ['class' => 'input'],
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez un ou plusieurs livres.',
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true
            ])
            
            ->add('film', EntityType::class, [
            'class' => Film::class,
            'choice_label' => 'titre_francais',
            'label' => 'Film(s)',
            'attr' => ['class' => 'input'],
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez un ou plusieurs films.',
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true
            ])
            
            ->add('serie', EntityType::class, [
            'class' => Serie::class,
            'choice_label' => 'titre_francais',
            'label' => 'Série(s)',
            'attr' => ['class' => 'input'],
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez une ou plusieurs séries.',
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true  
            ])
            
            ->add('album', EntityType::class, [
            'class' => Album::class,
            'choice_label' => 'titre_francais',
            'label' => 'Albums(s)',
            'attr' => ['class' => 'input'],
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez un ou plusieurs albums.',
            'row_attr' => ['class' => 'mx-5 my-3'],
            'required' => true
            ])

            ->remove('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artiste::class,
        ]);
    }
}
