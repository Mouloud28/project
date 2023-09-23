<?php

namespace App\Form;

use App\Entity\Forum;
use App\Entity\Genre;
use App\Entity\Serie;
use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_francais', TextType::class, [
                'label' => 'Titre français',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le titre français de la série.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre français de la série.'
                    ])
                ]
            ])

            ->add('titre_original', TextType::class, [
                'label' => 'Titre original',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le titre original de la série.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre original de la série.'
                    ])
                ]
            ])

            ->add('createur', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Créateur(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs créateurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs créateurs.'
                    ])
                ]
            ])

            ->add('producteur', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Producteur(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs producteurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs producteurs.'
                    ])
                ]
            ])

            ->add('scenariste', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Scénariste(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs scénaristes.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs scénaristes.'
                    ])
                ]
            ])

            ->add('casting', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Casting',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs acteurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le casting.'
                    ])
                ]
            ])

            ->add('compositeur', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Compositeur(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs compositeurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs compositeurs.'
                    ])
                ]
            ])

            ->remove('affiche')

            ->add('imageFile', FileType::class, [
                'label' => 'Affiche',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'enctype' => 'multipart/form-data',
                    'placeholder' => 'Sélectionnez l\'affiche de la série.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner l\'affiche de la série.'
                    ])
                ]
            ])

            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'label_attr' => ['class' => 'fw-bold'],
                'choice_label' => 'nom',
                'label' => 'Genre(s)',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs genres.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs genres.'
                    ])
                ]
            ])

            ->add('duree', TimeType::class, [
                'label' => 'Durée',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'placeholder' => 'Renseignez la durée d\'un épisode.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la durée d\'un épisode.'
                    ])
                ]
            ])

            ->add('synopsis', TextareaType::class, [
                'label' => 'Synopsis',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le synopsis de la série.',
                    'rows' => 10
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le synopsis de la série.'
                    ])
                ]
            ])

            ->add('pays_origine', TextType::class, [
                'label' => 'Pays d\'origine',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le pays d\'origine de la série.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le pays d\'origine de la série.'
                    ])
                ]
            ])

            ->add('date_diffusion_france', DateType::class, [
                'label' => 'Date de diffusion (France)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'placeholder' => 'Renseignez la date de diffusion française de la série.'
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date de diffusion française de la série.'
                    ])
                ]
            ])

            ->add('date_diffusion_pays_origine', DateType::class, [
                'label' => 'Date de diffusion (Pays d\'origine)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'placeholder' => 'Renseignez la date de diffusion dans le pays d\'origine de la série.'
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date de diffusion dans le pays d\'origine de la série.'
                    ])
                ]
            ])

            ->add('imageFile2', FileType::class, [
                'label' => 'Bandes-annonce(s) et teaser(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Sélectionnez un(e) ou plusieur(s) bande(s)-annonce(s) / teaser(s).'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Sélectionnez un(e) ou plusieur(s) bande(s)-annonce(s) / teaser(s).'
                    ])
                ]
            ])

            ->add('nombre_saisons', NumberType::class, [
                'label' => 'Nombre de saisons',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le nombre de saisons de la série.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le nombre de saisons de la série.'
                    ])
                ]
            ])

            ->add('statut', TextType::class, [
                'label' => 'Statut',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le statut de la série.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le statut de la série.'
                    ])
                ]
            ])

            ->add('forum', EntityType::class, [
                'class' => Forum::class,
                'choice_label' => 'nom',
                'label' => 'Forum',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le forum du livre.',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le forum du livre.'
                    ])
                ]
            ])

            ->remove('updatedAt');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
