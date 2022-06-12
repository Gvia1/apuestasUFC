<?php

namespace App\Form;

use App\Entity\Apuesta;
use App\Entity\Metodo;
use App\Entity\MetodoEspecifico;
use App\Entity\Peleador;
use App\Entity\Peleadores;
use Doctrine\ORM\EntityRepository;
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
                'class' => Peleador::class,
                'choices' => $options['peleadores'],
                'choice_label' => function (Peleador $peleador) {
                    return $peleador->getNombre();
                    },
                'placeholder' => 'Seleccione',
                ])

            ->add('round',ChoiceType::class, [
                'placeholder' => 'Seleccione',
                'choices'  => [
                    range(0,$options['rounds'],1),
                ],
                'required' => false
                
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
            ->add('cantidad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apuesta::class,
            'peleadores' => null,
            'rounds' => null
        ]);
    }
}
