<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;




class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('synopsis', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Synopsis',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('country', CountryType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_translation_domain' => 'FR',
                'label' => 'Pays de production',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('year', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Année de production',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('category', null, ['choice_label' => 'name'], CategoryType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Genre',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('actors', EntityType::class, [
                'label' => 'Acteurs',
                'class' => Actor::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false
                ])
                
            ->add('posterFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
