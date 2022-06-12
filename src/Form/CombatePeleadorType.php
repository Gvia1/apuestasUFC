<?php

namespace App\Form;

use App\Entity\Combate;
use App\Entity\CombatePeleador;
use App\Entity\Metodo;
use App\Entity\MetodoEspecifico;
use App\Entity\Peleador;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CombatePeleadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ganador',ChoiceType::class, [
                'placeholder' => 'Seleccione',
                'choices'  => [
                    'Si' => true,
                    'No' => false
                ],
                'required' => false
            ])
            ->add('round',ChoiceType::class, [
                'placeholder' => 'Seleccione',
                'choices'  => [
                    '3' => '3',
                    '5' => '5'
                ],
            ])
            ->add('peleador', EntityType::class, [
                'placeholder' => 'Seleccione',
                'class' => Peleador::class,
                'choice_label' => 'nombre',
                ])
            ->add('peleador2', EntityType::class, [
                'placeholder' => 'Seleccione',
                'class' => Peleador::class,
                'choice_label' => 'nombre',
                'mapped' => false
                ])
            ->add('combate', EntityType::class, [
                'placeholder' => 'Seleccione',
                'class' => Combate::class,
                'choice_label' => 'nombre',
                ])
            ->add('metodo', EntityType::class, [
                'placeholder' => 'Seleccione',
                'class' => Metodo::class,
                'choice_label' => 'descripcion',
                'required' => false
                ])
            ->add('metodoEspecifico', EntityType::class, [
                'placeholder' => 'Seleccione',
                'class' => MetodoEspecifico::class,
                'choice_label' => 'descripcion',
                'required' => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CombatePeleador::class,
        ]);
    }
}
