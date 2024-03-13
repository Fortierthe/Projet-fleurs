<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class AccountDeleteType extends AbstractType
{

    private $csrfTokenManager;

    public function __construct(CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('_token', HiddenType::class, [
            'mapped' => false,
            'attr' => [
                'value' => $this->csrfTokenManager->getToken('delete-account')->getValue(),
            ],
        ])
            ->add('submit', SubmitType::class, [
                'label' => 'Confirmer la suppression',
                'attr' => [
                    'class' => 'btn btn-danger'
                ],
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false, // Disable CSRF protection for this form
        ]);
    }

}
