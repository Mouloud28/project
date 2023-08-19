<?php

namespace App\Form;

use App\Entity\Album;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_francais')
            ->add('titre_original')
            ->add('affiche')
            ->add('pays_origine')
            ->add('track')
            ->add('single')
            ->add('date_enregistrement')
            ->add('date_sortie_france')
            ->add('date_sortie_pays_origine')
            ->add('label')
            ->remove('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
