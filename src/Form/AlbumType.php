<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Forum;
use App\Entity\Genre;
use App\Entity\Artiste;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Form\BandesAnnoncesTeasersType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_francais', TextType::class, [
                'label' => 'Titre français',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le titre français de l\'album.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre français de l\'album.'
                    ])
                ]
            ])

            ->add('titre_original', TextType::class, [
                'label' => 'Titre original',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le titre original de l\'album.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre original de l\'album.'
                    ])
                ]
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();

            $form->add('compositeurs', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Compositeur(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez un ou plusieurs compositeurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs compositeurs.'
                    ])
                ],
                'data' => $data->getCompositeurs()
            ]);
        })

            ->remove('affiche')

            ->add('imageFile', FileType::class, [
                'label' => 'Affiche',
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

            ->add('pays_origine', TextType::class, [
                'label' => 'Pays d\'origine',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le pays d\'origine de l\'album.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le pays d\'origine de l\'album.'
                    ])
                ]
            ])

            ->add('track', TextType::class, [
                'label' => 'Tracks',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez un morceau musical.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un morceau musical.'
                    ])
                ]
            ])

            ->add('single', TextType::class, [
                'label' => 'Single(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez un single.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un single.'
                    ])
                ]
            ])

            ->add('date_enregistrement', DateType::class, [
                'label' => 'Date d\'enregistrement',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez la date d\'enregistrement de l\'album.'
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date d\'enregistrement de l\'album.'
                    ])
                ]
            ])

            ->add('date_sortie_france', DateType::class, [
                'label' => 'Date de sortie (France)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez la date de sortie (France).'
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date de sortie (France).'
                    ])
                ]
            ])

            ->add('date_sortie_pays_origine', DateType::class, [
                'label' => 'Date de sortie (Pays d\'origine)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez la date de sortie (Pays d\'origine).'
                ],
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner la date de sortie (Pays d\'origine).'
                    ])
                ]
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();

            $form->add('producteurs', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Producteur(s)',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez un ou plusieurs producteurs.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un ou plusieurs producteurs.'
                    ])
                ],
                'data' => $data->getProducteurs()
            ]);
        })

            ->add('label', TextType::class, [
                'label' => 'Label',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le label.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez le label.'
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
            'data_class' => Album::class,
        ]);
    }
}
