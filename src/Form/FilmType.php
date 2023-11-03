<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Forum;
use App\Entity\Genre;
use App\Entity\Langue;
use App\Entity\Artiste;
use App\Form\BandesAnnoncesTeasersType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_francais', TextType::class, [
                'label' => 'Titre français',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le titre français du film.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre français du film.'
                    ])
                ]
            ])

            ->add('titre_original', TextType::class, [
                'label' => 'Titre original',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le titre original du film.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre original du film.'
                    ])
                ]
            ])

            ->add('realisateur', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Réalisateur(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs réalisateurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs réalisateurs.'
                    ])
                ]
            ])

            ->add('imageFile', FileType::class, [
                'label' => 'Affiche',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'enctype' => 'multipart/form-data',
                    'placeholder' => 'Sélectionnez l\'affiche du film.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner l\'affiche du film.'
                    ])
                ]
            ])

            ->remove('affiche')

            ->add('langue', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'nom',
                'label' => 'Langue d\'origine',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez la langue originale du film.',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la langue originale du film.'
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
                    'placeholder' => 'Renseignez la durée du film.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la durée du film.'
                    ])
                ]
            ])

            ->add('synopsis', TextareaType::class, [
                'label' => 'Synopsis',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le synopsis du film.',
                    'rows' => 10
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le synopsis du film.'
                    ])
                ]
            ])

            ->add('pays_origine', TextType::class, [
                'label' => 'Pays d\'origine',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le pays d\'origine du film.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le pays d\'origine du film.'
                    ])
                ]
            ])

            ->add('date_sortie_france', DateType::class, [
                'label' => 'Date de sortie (France)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'placeholder' => 'Renseignez la date de sortie française du film.'
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date de sortie française du film.'
                    ])
                ]
            ])

            ->add('date_sortie_pays_origine', DateType::class, [
                'label' => 'Date de sortie (Pays d\'origine)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'placeholder' => 'Renseignez la date de sortie dans le pays d\'origine du film.'
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date de sortie dans le pays d\'origine du film.'
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
                        'message' => 'Veuillez renseigner un ou plusieurs acteurs.'
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

            // ->add('imageFile2', FileType::class, [
            //     'label' => 'Bandes-annonce(s) et teaser(s)',
            //     'label_attr' => ['class' => 'fw-bold mx-5 my-3'],
            //     'attr' => [
            //         'class' => 'input',
            //         'placeholder' => 'Sélectionnez un(e) ou plusieur(s) bande(s)-annonce(s) / teaser(s).'
            //     ],
            //     'row_attr' => ['class' => 'mx-5 my-3'],
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Sélectionnez un(e) ou plusieur(s) bande(s)-annonce(s) / teaser(s).'
            //         ])
            //     ]
            // ])

            ->add('bandesAnnoncesTeasers', CollectionType::class, [
                'label' => 'Bandes-annonce(s) et teaser(s)',
                'label_attr' => ['class' => 'fw-bold mx-5 my-3'],
                'entry_type' => BandesAnnoncesTeasersType::class,
                'allow_add'=> true,
                'allow_delete' => true,
                'by_reference' => false
                ])  

            ->add('forum', EntityType::class, [
                'class' => Forum::class,
                'choice_label' => 'nom',
                'label' => 'Forum',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le forum du film.',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le forum du film.'
                    ])
                ]
            ])

            ->remove('updatedAt');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
