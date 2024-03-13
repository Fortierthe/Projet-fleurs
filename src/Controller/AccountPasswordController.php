<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager;
    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/modifMdp', name: 'app_account_password')]
    public function index(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $notif = null;
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $old_password = $form->get('old_password')->getData();
            if($encoder->isPasswordValid($user,$old_password)){
                // dd($old_password);
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user,  $new_pwd);
                $user->setPassword($password);
    
                // $entityManager = $this->getDoctrine()->getManager();
                // $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notif = "Votre mot de passe a bien été mis à jour";
            }
            else{
                $notif = "L'ancien mot de passe est incorrect.";
            }
        }
        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notif' => $notif
        ]);
    }
}
