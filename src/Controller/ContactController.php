<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setCreatedAt(new \DateTime());
                
                
                
            
            $contentMail = $this->renderView('contact/email.html.twig', [
                // Passer les variables nécessaires à votre modèle Twig
                'nom' => $contact->getName(),
                'email' => $contact->getEmail(),
                'phone' => $contact->getPhone(),
                'date' => $contact->getDateNaissance()->format('d/m/Y'),
                'genre' => $contact->getGenre(),
                'metier' => $contact->getMetier(),
                'sujet' => $contact->getSubject(),
                'message' => $contact->getMessage(),
            ]);

            
            /*
            return $this->render('contact/email.html.twig', [
                // Passer les variables nécessaires à votre modèle Twig
                'nom' => $contact->getName(),
                'email' => $contact->getEmail(),
                'phone' => $contact->getPhone(),
                'date' => $contact->getDateNaissance()->format('d/m/Y'),
                'genre' => $contact->getGenre(),
                'metier' => $contact->getMetier(),
                'sujet' => $contact->getSubject(),
                'message' => $contact->getMessage(),
            ]);
            */
            

            
            $email = (new Email())
                ->from('flowerstore@laposte.net')
                ->to($contact->getEmail())
                ->cc('flowerstore@laposte.net')    
                ->bcc('fortierthe@cy-tech.fr')
                ->subject('Demande de contact FlowerStore')
                ->text('')
                ->html($contentMail);

            try {
                
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                // some error prevented the email sending; display an
                // error message or try to resen
            }

            $this->addFlash('success', 'Your message has been sent successfully.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
