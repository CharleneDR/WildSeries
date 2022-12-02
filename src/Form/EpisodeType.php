<?php

namespace App\Form;

use App\Entity\Episode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class EpisodeType extends AbstractType
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
            ->add('number', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Numéro de l\'épisode',
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
            ->add('season', null, ['choice_label' => 'number'], SeasonType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Saison associée',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Episode::class,
        ]);
    }
}
