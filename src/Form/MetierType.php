<?php

namespace App\Form;

use App\Entity\Metier;
use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MetierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Métier',
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Renseignez un métier.'
                ],
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => true
            ])

            ->add('artiste', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Artiste(s)',
                'attr' => [
                    'class' => 'input select-2',
                    'data-placeholder' => 'Sélectionnez un ou plusieurs artistes.'
                ],
                'expanded' => false,
                'multiple' => true,
                'row_attr' => ['class' => 'mx-5 my-3'],
                'required' => false
            ])
            ->remove('updatedAt');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Metier::class,
        ]);
    }
}
