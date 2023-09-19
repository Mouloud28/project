<?php

namespace App\Form;

use App\Entity\Forum;
use App\Entity\Genre;
use App\Entity\Livre;
use App\Entity\Langue;
use App\Entity\Artiste;
use App\Entity\Editeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options,): void
    {
        $builder

            ->add('titre_francais', TextType::class, [
                'label' => 'Titre français',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le titre français du livre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre français du livre.'
                    ])
                ]
            ])

            ->add('titre_original', TextType::class, [
                'label' => 'Titre original',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le titre original du livre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre original du livre.'
                    ])
                ]
            ])

            ->add('auteur', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Auteur(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'placeholder' => 'Renseignez un ou plusieurs auteurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs auteurs.'
                    ])
                ]
            ])

            ->remove('couverture')

            ->add('imageFile', FileType::class, [
                'label' => 'Couverture',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'enctype' => 'multipart/form-data',
                    'placeholder' => 'Sélectionnez la couverture du livre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner la couverture du livre.'
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
                    'placeholder' => 'Renseignez un ou plusieurs genres.'
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

            ->add('synopsis', TextareaType::class, [
                'label' => 'Synopsis',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le synopsis du livre.',
                    'rows' => 10
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le synopsis du livre.'
                    ])
                ]
            ])

            ->add('pays_origine', TextType::class, [
                'label' => 'Pays d\'origine',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le pays d\'origine du livre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le pays d\'origine du livre.'
                    ])
                ]
            ])

            ->add('date_publication_france', DateType::class, [
                'label' => 'Date de publication (France)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez la date de publication française du livre.'
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date de publication française du livre.'
                    ])
                ]
            ])

            ->add('date_publication_pays_origine', DateType::class, [
                'label' => 'Date de publication (Pays d\'origine)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez la date de publication dans le pays d\'origine du livre.',
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date de publication dans le pays d\'origine du livre.'
                    ])
                ]
            ])

            ->add('langue', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'nom',
                'label' => 'Langue d\'origine',
                'label_attr' => ['class' => 'fst-italic'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez la langue originale du livre.',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la langue originale du livre.'
                    ])
                ]
            ])

            ->add('ISBN', TextType::class, [
                'label' => 'ISBN',
                'label_attr' => ['class' => 'fst-italic'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez l\'ISBN du livre.',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner l\'ISBN du livre.'
                    ])
                ]
            ])

            ->remove('updatedAt')

            ->add('traducteur', EntityType::class, [
                'class' => Artiste::class,
                'mapped' => true,
                'choice_label' => 'nom',
                'label' => 'Traducteur(s)',
                'label_attr' => ['class' => 'fst-italic'],
                'attr' => [
                    'class' => 'input select-2',
                    'placeholder' => 'Renseignez un ou plusieurs traducteurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs traducteurs.'
                    ])
                ]
            ])

            ->add('editeur_pays_origine', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'nom',
                // 'entry_type' => EntityType::class,
                // 'entry_options' => [
                //      'class' => Editeur::class,
                //      'choice_label' => 'nom', // Utilisez le champ 'editeur.nom' de l'éditeur comme libellé
                //  ],
                'label' => 'Éditeur(s)',
                'label_attr' => ['class' => 'fst-italic'],
                'attr' => [
                    'class' => 'input select-2',
                    'placeholder' => 'Renseignez un ou plusieurs éditeurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs éditeurs.'
                    ])
                ]
            ])

            ->add('editeur_france', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'nom',
                'label' => 'Éditeur(s)',
                'label_attr' => ['class' => 'fst-italic'],
                'attr' => [
                    'class' => 'input select-2',
                    'placeholder' => 'Renseignez un ou plusieurs éditeurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => false,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs éditeurs.'
                    ])
                ]
            ])

            ->add('ISBN_france', TextType::class, [
                'label' => 'ISBN',
                'label_attr' => ['class' => 'fst-italic'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez l\'ISBN du livre.',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner l\'ISBN du livre.'
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
