<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class InformationController extends AbstractController
{
    #[Route('/information', name: 'app_information')]
    public function index(): Response
    {
        return $this->render('information/index.html.twig', [
            'controller_name' => 'InformationController',
        ]);
    }

    #[Route('/email', name: 'send_email')]

    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('flowerstore@laposte.net')
            ->to('fortierthe@cy-tech.fr')
            ->subject('Sujet de l\'email')
            ->text('Contenu du message')
            ->html('<p>Contenu du message en HTML</p>');

        $mailer->send($email);
        return $this->render('email/envoye.html.twig');
    }
}
