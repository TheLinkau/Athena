<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, [
                'label' => 'Question'
            ])
            ->add('answerA', TextType::class, [
                'mapped' => false,
                'label' => 'Réponse 1'
            ])
            ->add('answerB', TextType::class, [
                'mapped' => false,
                'label' => 'Réponse 2'
            ])
            ->add('answerC', TextType::class, [
                'mapped' => false,
                'label' => 'Réponse 3'
            ])
            ->add('answerD', TextType::class, [
                'mapped' => false,
                'label' => 'Réponse 4'
            ])
            ->add('rightAnswer', IntegerType::class, [
                'label' => 'Bonne réponse (1-4)'
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
