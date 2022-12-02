<?php

namespace App\Form;

use App\Entity\Season;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class SeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Numéro de la saison',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('year', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Année de sortie',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('program', null, ['choice_label' => 'title'], ProgramType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Série associée',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }
}
