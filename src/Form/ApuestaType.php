<?php

namespace App\Form;

use App\Entity\Apuesta;
use App\Entity\Peleadores;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApuestaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ganador', EntityType::class, [
                'class' => Peleadores::class,
                'choice_label' => 'nombre',
                ])

            ->add('metodo', ChoiceType::class, [
                'choices'  => [
                    'KO' => 'KO',
                    'TKO' => 'TKO',
                    'Decision' => 'Decision',
                ]
            ])
            ->add('round',ChoiceType::class, [
                'choices'  => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ]
            ])
            ->add('metodoEspecifico')
            ->add('cantidad',MoneyType::class, [
                'attr' => [
                  'type' => 'number',
                ],
                'currency' => 'EUR',
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apuesta::class,
        ]);
    }
}
