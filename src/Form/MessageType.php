<?php

// src/Form/ContactType.php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('genre', ChoiceType::class, [
                'label' => 'Genre',
                'choices'  => [
                    'Femme' => 'femme',
                    'Homme' => 'homme',
                ],
                'expanded' => true, // pour afficher sous forme de boutons radio
                'multiple' => false,
            ])
            ->add('date_naissance', DateType::class, [
                'label' => 'Date de Naissance',
                'widget' => 'single_text',
            ])
            ->add('metier', TextType::class, [
                'label' => 'Métier',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'required' => false,
            ])
            ->add('subject', TextType::class, [
                'label' => 'Subject',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
