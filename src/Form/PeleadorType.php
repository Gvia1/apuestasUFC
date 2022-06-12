<?php

namespace App\Form;

use App\Entity\Division;
use App\Entity\Peleador;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeleadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('alias')
            ->add('apellido')
            ->add('edad')
            ->add('altura')
            ->add('peso')
            ->add('victorias')
            ->add('derrotas')
            ->add('empates')
            ->add('division', EntityType::class, [
                'placeholder' => 'Seleccione',
                'class' => Division::class,
                'choice_label' => 'nombre',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Peleador::class,
        ]);
    }
}
