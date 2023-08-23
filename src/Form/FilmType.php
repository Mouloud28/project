<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Forum;
use App\Entity\Genre;
use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_francais')
            ->add('titre_original')
            ->add('artistes', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Réalisateur(s)',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs réalisateurs',
                'required' => true])
            ->add('imageFile', FileType::class, ['label' => 'Affiche'])
            ->remove('affiche')
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom',
                'label' => 'Genre(s)',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs genres',
                'required' => true])
            ->add('duree')
            ->add('synopsis')
            ->add('pays_origine')
            ->add('date_sortie_france')
            ->add('date_sortie_pays_origine')
            ->add('artistes_', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Scénariste(s)',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs auteurs',
                'required' => true])
            ->add('artistes__', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Producteur(s)',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs auteurs',
                'required' => true])
            ->add('artistes___', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Casting',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs auteurs',
                'required' => true])
            ->add('artistes____', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'label' => 'Compositeur(s)',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => 'Sélectionnez un ou plusieurs auteurs',
                'required' => true])
            ->add('bandes_annonces_teasers')
            ->add('forum', EntityType::class, [
                'class' => Forum::class,
                'choice_label' => 'nom',
                'label' => 'Forum',
                ])
            ->remove('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
