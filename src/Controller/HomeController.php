<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SessionInterface $session,EntityManagerInterface $entityManager): Response
    {
        //$this->getUser()->setRoles(["ROLE_ADMIN"]);
        //print_r($this->getUser()->getRoles());
        //$entityManager->flush();

        // $session->remove('cart');
        // $session->set('cart', [
        //     [
        //         'id' => 522,
        //         'quantity' => 12
        //     ]
        // ]);
        // $cart = $session->get('cart');

        return $this->render('home/index.html.twig');
    }
}
