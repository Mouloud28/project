<?php

namespace App\Form;

use App\Entity\Editeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EditeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('pays_origine')
            ->add('date_creation', DateType::class, [
                'label' => 'Date de création',
                'format' => 'dd/MM/yyyy',
                'years' => range(0000, date('Y')),
            ])
            ->remove('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Editeur::class,
        ]);
    }
}
