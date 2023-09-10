<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Serie;
use App\Entity\Artiste;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
use Symfony\Component\Form\Extension\Core\Type\NumberType;

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
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();

            $form->add('artistes', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Créateur(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez un ou plusieurs créateurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs créateurs.'
                    ])
                ],
                'data' => $data->getArtistes()
            ]);
        })

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
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();

            $form->add('genres', EntityType::class, [
                'class' => Genre::class,
                'label_attr' => ['class' => 'fw-bold'],
                'choice_label' => 'nom',
                'label' => 'Genre(s)',
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez un ou plusieurs genres.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs genres.'
                    ])
                ],
                'data' => $data->getGenres()
            ]);
        })

            ->add('duree', TimeType::class, [
                'label' => 'Durée',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
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
                    'class' => 'input',
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
                    'class' => 'input',
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

            // ->add('imageFile2', FileType::class, [
            //     'label' => 'Bandes-annonce(s) et teaser(s)',
            //     'label_attr' => ['class' => 'fw-bold'],
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

            // ->add('imageFile2', FileType::class, [
            //     'label' => 'Bandes-annonce(s) et teaser(s)',
            //     'label_attr' => ['class' => 'fw-bold'],
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
            //     ])

            ->add('bandesAnnoncesTeasers', CollectionType::class, [
                'entry_type' => BandesAnnoncesTeasersType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                // 'label' => 'Bandes-annonce(s) et teaser(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Sélectionnez un(e) ou plusieur(s) bandes-annonce(s) / teaser(s).'
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

            ->remove('updatedAt');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
