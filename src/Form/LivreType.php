<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_francais')
            ->add('titre_original')
            ->add('couverture')
            ->add('synopsis')
            ->add('pays_origine')
            ->add('date_publication_france')
            ->add('date_publication_pays_origine')
            ->add('ISBN')
            ->add('imageFile', FileType::class, ['label' => 'Image'])
            ->remove('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
