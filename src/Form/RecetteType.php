<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de la recette',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control']
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de la recette',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'image_uri' => true,
                'attr' => ['class' => 'form-control-file']
            ])
            ->add('tempsPreparation', IntegerType::class, [
                'label' => 'Temps de préparation (en minutes)',
                'attr' => ['class' => 'form-control']
            ])
            ->add('tempsCuisson', IntegerType::class, [
                'label' => 'Temps de cuisson (en minutes)',
                'attr' => ['class' => 'form-control']
            ])
            ->add('portions', IntegerType::class, [
                'label' => 'Nombre de portions',
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
