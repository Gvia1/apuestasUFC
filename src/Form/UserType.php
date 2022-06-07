<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('Nombre')
            ->add('Apellidos')
            ->add('Direccion')
            ->add('Localidad')
            ->add('email')
            ->add('telefono')
            ->add('entidad')
            ->add('oficina')
            ->add('dc')
            ->add('numero_cuenta')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
