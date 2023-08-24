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
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_francais')
            ->add('titre_original')
            ->add('artistes', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Auteur(s)',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs auteurs',
                'required' => true])
            ->remove('couverture')
            ->add('imageFile', FileType::class, ['label' => 'Couverture'])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom',
                'label' => 'Genre(s)',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs genres',
                'required' => true])
            ->add('synopsis')
            ->add('pays_origine')
            ->add('date_publication_france')
            ->add('date_publication_pays_origine')
            ->add('langue', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'nom',
                'label' => 'Langue d\'origine',
            ])
            
            ->add('editeurs', EntityType::class, [
                'class' => Editeur::class,
                'multiple' => true,
                'choice_label' => 'nom',
                'label' => 'Editeur(s)',
            ])

            ->add('ISBN')

            ->remove('updatedAt')

            ->add('artistes_', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Traducteur',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs auteurs',
                'required' => true])
            
            ->add('editeurs_', EntityType::class, [
                'class' => Editeur::class,
                'multiple' => true,
                'choice_label' => 'nom',
                'label' => 'Editeur(s)',
                ])
            
            ->add('ISBN_')

            ->add('forum', EntityType::class, [
                'class' => Forum::class,
                'choice_label' => 'nom',
                'label' => 'Forum',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
