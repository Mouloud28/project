<?php

namespace App\Form;

use App\Entity\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_francais')
            ->add('titre_original')
            ->add('affiche')
            ->add('duree')
            ->add('synopsis')
            ->add('pays_origine')
            ->add('date_sortie_france')
            ->add('date_sortie_pays_origine')
            ->add('bandes_annonces_teasers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
