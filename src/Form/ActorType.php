<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ActorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])

            ->add('birthday', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd/MM/yyyy',
                'years' => range(date('Y'), date('Y')-100),
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Anniversaire',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])

            ->add('nationality', CountryType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_translation_domain' => 'FR',
                'label' => 'Origine',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])

            ->add('biography', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Biographie',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])

            ->add('actorFile', VichFileType::class, [
                'required' => true,
                'allow_delete' => false,
            ])
            
            ->add('programs', EntityType::class, [
                'label' => 'Séries',
                'class' => Program::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actor::class,
        ]);
    }
}
