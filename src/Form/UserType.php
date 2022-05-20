<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', null, ['attr' => ['placeholder' => 'pseudo']])
          //  ->add('password', PasswordType::class, ['attr' => ['placeholder' => 'mot de passe'] ])
            ->add('plainPassword', RepeatedType::class, array(
                'type'              => PasswordType::class,
                'mapped'            => false,
                'first_options' => ['label' => false, 'attr' => ['placeholder' => 'Password']],
                'second_options' => ['label' => false,'attr' => ['placeholder' => 'Confirm Password']],
                'invalid_message' => 'The password fields must match.',
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
