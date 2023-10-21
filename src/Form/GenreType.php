<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Album;
use App\Entity\Genre;
use App\Entity\Livre;
use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Genre',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez le genre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                    'message' => 'Veuillez renseigner le genre.'
                    ])
                ]
            ])
            ->remove('updatedAt')

            ->add('livres', EntityType::class, [
                'class' => Livre::class,
                'choice_label' => 'titre_francais',
                'label' => 'Livre',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Renseignez le genre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false,
                'multiple' => true,
                'expanded' => false
            ])

            ->add('film', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'titre_francais',
                'label' => 'Film',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Renseignez le genre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false,
                'multiple' => true,
                'expanded' => false
            ])

            ->add('serie', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'titre_francais',
                'label' => 'Série',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Renseignez le genre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false,
                'multiple' => true,
                'expanded' => false
            ])

            ->add('album', EntityType::class, [
                'class' => Album::class,
                'choice_label' => 'titre_francais',
                'label' => 'Album',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Renseignez le genre.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false,
                'multiple' => true,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Genre::class,
        ]);
    }
}
