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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                'row_attr' => ['class' => 'mx-5 my-3 fw-bold'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le nom de l\'artiste'
                    ])
                ]
            ])

            ->add('date_naissance', DateType::class, [
                'label' => 'Date de naissance',
                'attr' => ['class' => 'input'],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'attr' => ['class' => 'custom-date-input'],
                'row_attr' => ['class' => 'mx-5 my-3 fw-bold'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une date de naissance'
                    ])
                ]
            ])

            ->add('date_deces', DateType::class, [
                'label' => 'Date de décès',
                'attr' => ['class' => 'input'],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'attr' => ['class' => 'custom-date-input'],
                'row_attr' => ['class' => 'mx-5 my-3 fw-bold'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une date de décès'
                    ])
                ]
            ])

            ->add('pays_origine', TextType::class, [
                'label' => 'Pays d\'origine',
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Sélectionnez un pays.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3 fw-bold'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un pays d\'origine'
                    ])
                ]
            ])

            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'attr' => ['class' => 'input'],
                'choice_label' => 'nom',
                'label' => 'Ville d\'origine',
                'expanded' => false,
                'placeholder' => 'Sélectionnez une ville.',
                'row_attr' => ['class' => 'mx-5 my-3 fw-bold'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une ville de naissance'
                    ])
                ]
            ])

            ->add('imageFile', FileType::class, [
                'label' => 'Photo',
                'attr' => [
                    'class' => 'input',
                    'enctype' => 'multipart/form-data'
                ],
                'required' => false,
                'row_attr' => ['class' => 'mx-5 my-3 fw-bold'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez télécharger une photo.'
                    ])
                ]
            ])

            ->remove('photo')

            ->add('metiers', EntityType::class, [
                'class' => Metier::class,
                'choice_label' => 'nom',
                'label' => 'Activité(s)',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez une ou plusieurs activités.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3 fw-bold'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir au moins une activité'
                    ])
                ]
            ])

            ->add('auteurs_livres', EntityType::class, [
                'class' => Livre::class,
                'choice_label' => 'titre_francais',
                'label' => 'Ecriture',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs livres.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('traducteurs_livres', EntityType::class, [
                'class' => Livre::class,
                'choice_label' => 'titre_francais',
                'label' => 'Traduction',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs livres.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('realisateurs_films', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'titre_francais',
                'label' => 'Réalisation',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs films.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('scenaristes_films', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'titre_francais',
                'label' => 'Scénario(s)',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs films.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('producteurs_films', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'titre_francais',
                'label' => 'Production',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs films.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('casting_film', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'titre_francais',
                'label' => 'Acting',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs films.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('compositeurs_films', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'titre_francais',
                'label' => 'Composition',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs films.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('createurs_series', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'titre_francais',
                'label' => 'Création',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez une ou plusieurs séries.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('scenaristes_series', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'titre_francais',
                'label' => 'Scénario(s)',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez une ou plusieurs séries.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('producteurs_series', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'titre_francais',
                'label' => 'Production',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez une ou plusieurs séries.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('casting_serie', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'titre_francais',
                'label' => 'Acting',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez une ou plusieurs séries.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('compositeurs_series', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'titre_francais',
                'label' => 'Composition',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez une ou plusieurs séries.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('compositeurs_albums', EntityType::class, [
                'class' => Album::class,
                'choice_label' => 'titre_francais',
                'label' => 'Composition',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs albums.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('producteurs_albums', EntityType::class, [
                'class' => Album::class,
                'choice_label' => 'titre_francais',
                'label' => 'Production',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs albums.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])

            ->add('presentation', TextareaType::class, [
                'label' => 'Présentation générale',
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez une présentation de l\'artiste.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3 fw-bold'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une présentation de l\'artiste'
                    ])
                ]
            ])

            ->remove('updatedAt');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artiste::class,
        ]);
    }
}
