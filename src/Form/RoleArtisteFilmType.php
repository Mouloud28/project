<?php

namespace App\Form;

use App\Entity\Metier;
use App\Entity\Artiste;
use App\Entity\RoleArtisteFilm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RoleArtisteFilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role', EntityType::class, [
                'class' => Metier::class,
                'choice_label' => 'nom',
                'label' => 'Rôle de l\'artiste',
                'multiple' => true,
                'expanded' => 'false',
            ])

            ->add('artiste', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Artiste',
            ])

            ->add('film')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RoleArtisteFilm::class,
        ]);
    }
}
