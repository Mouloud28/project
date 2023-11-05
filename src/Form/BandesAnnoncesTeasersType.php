<?php

namespace App\Form;

use App\Entity\BandesAnnoncesTeasers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BandesAnnoncesTeasersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Bandes-annonces / Teasers',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'enctype' => 'multipart/form-data',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
            ])
            ->add('imageFile2', FileType::class, [
                'label' => 'Poster',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'enctype' => 'multipart/form-data',
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                ])
            ->remove('poster')
            ->remove('video')
            ->remove('film')
            ->remove('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BandesAnnoncesTeasers::class,
        ]);
    }
}
