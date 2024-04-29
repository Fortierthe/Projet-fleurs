<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\commande_paye;
use App\Entity\OrderDetails;
use App\Entity\User;
use App\Form\OrderType;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CommandePayeController extends AbstractController
{
    private $entityManager;

        public function __construct(EntityManagerInterface $entityManager){
            $this->entityManager = $entityManager;
        }

    #[Route('/commande/paye', name: 'app_commande_paye')]
    public function index(): Response
    {

        return $this->render('commande_paye/index.html.twig', [
            'controller_name' => 'CommandePayeController',
        ]);
    }
}
