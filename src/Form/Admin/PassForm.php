<?php

namespace App\Form\Admin;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class PassForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('oldPassword', PasswordType::Class, [
            'label' => 'Old password',
            'attr' => ['placeholder' => 'type your password here...']
        ])
        ->add('newPassword', PasswordType::Class, [
            'label' => 'New password',
            'attr' => ['placeholder' => 'type your password here...']
        ])
        ->add('newPasswordConfirm', PasswordType::Class, [
            'label' => 'New password confirmation',
            'attr' => ['placeholder' => 'You must confirm you password here...']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
