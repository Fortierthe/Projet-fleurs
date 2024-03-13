<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Cart;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

class CartController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Cart $cart): Response
    {

        // dd($cart->get());
        return $this->render('cart/index.html.twig',[
            'cart' => $cart->getFull()
            // 'cart' => $cartComplete
        ]);
    }


    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);
        // dd($id);
        // return $this->render('cart/index.html.twig');
        return $this->redirectToRoute('app_cart');
    }


    #[Route('/cart/remove', name: 'remove_my__cart')]
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        // dd($id);
        // return $this->render('cart/index.html.twig');
        return $this->redirectToRoute('app_product');
    }


    #[Route('/cart/delete/{id}', name: 'delete_to_cart')]
    public function delete(Cart $cart, $id): Response
    {
        $cart->delete($id);
        // dd($id);
        // return $this->render('cart/index.html.twig');
        return $this->redirectToRoute('app_cart');
    }


    #[Route('/cart/decrease/{id}', name: 'decrease_to_cart')]
    public function decrease(Cart $cart, $id): Response
    {
        $cart->decrease($id);
        // dd($id);
        // return $this->render('cart/index.html.twig');
        return $this->redirectToRoute('app_cart');
    }
}
