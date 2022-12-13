<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comment', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ton commentaire..'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('rate', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 5,
                    'value' => 5

                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('author', null, ['choice_label' => 'id'], UserType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
            ->add('episode', null, ['choice_label' => 'id'], EpisodeType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
