<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('answerA', TextType::class, [
                'mapped' => false
            ])
            ->add('answerB', TextType::class, [
                'mapped' => false
            ])
            ->add('answerC', TextType::class, [
                'mapped' => false
            ])
            ->add('answerD', TextType::class, [
                'mapped' => false
            ])
            ->add('rightAnswer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
