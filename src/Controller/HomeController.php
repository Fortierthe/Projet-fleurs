<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SessionInterface $session): Response
    {

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
