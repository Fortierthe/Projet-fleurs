<?php

namespace App\Controller;

use App\Form\AccountDeleteType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Address;


class AccountDeleteController extends AbstractController
{
    #[Route('/account/delete', name: 'account_delete')]
    public function deleteAccount(Request $request, EntityManagerInterface $entityManager, Security $security): Response {
        $form = $this->createForm(AccountDeleteType::class);
        $form->handleRequest($request);
    
        return $this->render('account/delete_confirm.html.twig', [
            'deleteForm' => $form->createView(),
        ]);
    }

    #[Route('/account/delete/confirm', name: 'account_delete_confirm')]
    public function deleteAccountConfirm(Request $request, EntityManagerInterface $entityManager, Security $security): Response {

        $user = $this->getUser();

        if (!$user) {
            throw new AccessDeniedException('Vous devez être connecté pour supprimer votre compte.');
        }

        // Suppression manuelle des entités Address liées
        $addresses = $entityManager->getRepository(Address::class)->findBy(['user' => $user]);
        foreach ($addresses as $address) {
            $entityManager->remove($address);
        }

        // Supprimez l'utilisateur
        $entityManager->remove($user);
        $entityManager->flush();

        // Déconnecter l'utilisateur et invalider la session
        $this->container->get('security.token_storage')->setToken(null);
        $request->getSession()->invalidate();

        $this->addFlash('success', 'Votre compte a été supprimé avec succès.');

        // Rediriger immédiatement après la suppression
        return $this->redirectToRoute('app_home');
    }

}
