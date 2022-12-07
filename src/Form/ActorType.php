<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


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
                'label' => 'Pays de production',
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
