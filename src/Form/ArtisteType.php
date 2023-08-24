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
            'placeholder' => 'Tapez le nom de l\'artiste.',
            'style' => 'background-color:rgba(217, 217, 217)'
            ],
            'required' => true
            ])

            ->add('date_naissance', DateType::class, [
            'label' => 'Date de naissance',
            // 'attr' => ['placeholder' => 'Renseignez la date de naissance de l\'artiste.'],
            'attr' => ['style' => 'background-color:rgba(217, 217, 217)'],
            'required' => true
            ])

            ->add('pays_origine', TextType::class, [
            'label' => 'Pays d\'origine',
            'attr' => [
            'placeholder' => 'Sélectionnez un pays.',
            'style' => 'background-color:rgba(217, 217, 217)'
            ],
            'required' => true
            ])

            ->add('ville', EntityType::class, [
            'class' => Ville::class,
            'choice_label' => 'nom',
            'label' => 'Ville d\'origine',
            'expanded' => false,
            'placeholder' => 'Sélectionnez une ville.',
            'attr' => ['style' => 'background-color:rgba(217, 217, 217)'],
            'required' => true
            ])

            ->add('imageFile', FileType::class, ['label' => 'Photo'])
            ->remove('photo')
            
            ->add('metiers', EntityType::class, [
            'class' => Metier::class,
            'choice_label' => 'nom',
            'label' => 'Activité(s)',
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez une ou plusieurs activités.',
            'required' => true])
            
            ->add('livre', EntityType::class, [
            'class' => Livre::class,
            'choice_label' => 'titre_francais',
            'label' => 'Livre(s)',
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez un ou plusieurs livres.',
            'required' => true
            ])
            
            ->add('film', EntityType::class, [
            'class' => Film::class,
            'choice_label' => 'titre_francais',
            'label' => 'Film(s)',
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez un ou plusieurs films.',
            'required' => true
            ])
            
            ->add('serie', EntityType::class, [
            'class' => Serie::class,
            'choice_label' => 'titre_francais',
            'label' => 'Série(s)',
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez une ou plusieurs séries.',
            'required' => true  
            ])
            
            ->add('album', EntityType::class, [
            'class' => Album::class,
            'choice_label' => 'titre_francais',
            'label' => 'Albums(s)',
            'expanded' => true,
            'multiple' => true,
            'placeholder' => 'Sélectionnez un ou plusieurs albums.',
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
