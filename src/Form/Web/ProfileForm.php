<?php

namespace App\Form\Web;

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


class ProfileForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::Class, [
                'label' => 'Name',
                'attr' => ['placeholder' => 'type your name here...']
            ])
            ->add('firstName', TextType::Class, 
            [
                'label' => 'Firstname',
                'attr' => ['placeholder' => 'type your firstname here...']
            ])
            ->add('address', TextType::Class, [
                'label' => 'Address',
                'attr' => ['placeholder' => 'type your address here...']
            ])
            ->add('number', NumberType::Class, [
                'label' => 'Number',
                'attr' => ['placeholder' => 'type your postal number here...']
            ])
            ->add('postalCode', NumberType::Class, [
                'label' => 'Postal Code',
                'attr' => ['placeholder' => 'type your postal code here...']
            ])
            ->add('city', TextType::Class, [
                'label' => 'City',
                'attr' => ['placeholder' => 'type your city here...']
            ])
            ->add('email', EmailType::Class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'type your email here...']
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
