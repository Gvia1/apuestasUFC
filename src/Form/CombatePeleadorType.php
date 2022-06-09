<?php

namespace App\Form;

use App\Entity\CombatePeleador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CombatePeleadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ganador')
            ->add('round')
            ->add('peleador')
            ->add('combate')
            ->add('metodo')
            ->add('metodoEspecifico')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CombatePeleador::class,
        ]);
    }
}
