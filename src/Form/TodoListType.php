<?php

namespace App\Form;

use App\Entity\TodoList;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class TodoListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Your new To-Do List',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'You need a title.']),
                    new Assert\Length([
                        'min' => 4,
                        'max' => 255,
                        'minMessage' => 'Your title is to short.',
                        'maxMessage' => 'Your title is to long.',
                    ]),
                ],
            ])
            ->add('priority', ChoiceType::class, [
                'label' => 'What priority levels is this idea',
                'choices' => [
                    'High Priority' => 'High',
                    'Medium Priority' => 'Medium',
                    'Low Priority' => 'Low',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TodoList::class,
        ]);
    }
}
