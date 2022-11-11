<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Image;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ImageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
        $builder
        ->add('file', FileType::class,[
            'mapped' => false,
            'constraints' => [
                new File([
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid image file',
                ])
            ],
        ])
        ->add('numLikes', null, ['attr' => ['class'=>'form-control']])
        ->add('numViews', null, ['attr' => ['class'=>'form-control']])
        ->add('numDownloads', null, ['attr' => ['class'=>'form-control']])
        ->add('category', EntityType::class, array(
            'class' => Category::class,
            'choice_label' => 'name'))
        ->add('Send', SubmitType::class, ['attr' => ['class'=>'pull-right btn btn-lg sr-button']]);
    ;
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
    
}
