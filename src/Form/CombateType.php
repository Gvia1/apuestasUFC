<?php

namespace App\Form;

use App\Entity\Combate;
use App\Entity\Division;
use App\Entity\Evento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CombateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('evento', EntityType::class, [
                'placeholder' => 'Seleccione',
                'class' => Evento::class,
                'choice_label' => 'nombre',
                ])
            ->add('rounds',ChoiceType::class, [
                'placeholder' => 'Seleccione',
                'choices'  => [
                    '3' => '3',
                    '5' => '5'
                ],
            ])
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
            'data_class' => Combate::class,
        ]);
    }
}
