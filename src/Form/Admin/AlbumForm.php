<?php

namespace App\Form\Admin;

use App\Entity\Album;
use App\Entity\Type;
use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AlbumForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr'  => ['placeholder' => 'Type the artist\'s name here...']
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'attr'  => ['placeholder' => 'Type the date here...'],
                'years'  => range(date('Y'), date('Y')-100),
            ])
            ->add('imageFile', VichFileType::class, [
                'required'       => true,
                'allow_delete'   => false, 
                'download_uri'   => '',
                'download_label' => '...'
            ])
            ->add('price', NumberType::class, [
                'label' => 'Price',
                'attr'  => [
                        'placeholder' => 'Type the price here...',
                        'min'  => 0.00,
                        'max'  => 100.00,
                        'step' => 1
                ]
            ])
            ->add('types', EntityType::class, [
                'label' => 'Type',
                'class' =>  Type::class,
                'choice_label' => function ($type) {
                    return $type->getName();
                }
            ])
            ->add('artists', EntityType::class, [
                'label' => 'Artist',
                'class' =>  Artist::Class,
                'choice_label' => function ($artist) {
                    return $artist->getName();
                }
            ])
            ->add('submit', SubmitType::class, [
                'label'  => 'register',
                'attr'   => ['class' => 'btn btn-success']
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
