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

            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Attribuez un nom à votre bande-annonce / teaser.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
            ])

            ->add('video', FileType::class, [
                'label' => 'Vidéo',
                'label_attr' => ['class' => 'fw-bold'],
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Attribuez un nom à votre bande-annonce / teaser.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
            ])

            ->remove('updatedAt')
            ->remove('film')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BandesAnnoncesTeasers::class,
        ]);
    }
}
