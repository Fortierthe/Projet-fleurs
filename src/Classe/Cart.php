<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

class Cart
{


    private $session;
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager, RequestStack $session)
    {
        $this->session = $session->getSession();
        $this->entityManager = $entityManager;
    }

    public function add($id)
    {
        $cart = $this->session->get('cart', []);

        if(!empty($cart[$id])){
            $cart[$id]++;
        }
        else {
            $cart[$id] = 1;
        }

        $this->session->set('cart', $cart);

    }

    // public function get(){
    //     return $this->session->get('cart');
    // }
    public function get() {
        if ($this->session->has('cart')) {
            return $this->session->get('cart');
        }
    
        return [];
    }
    

    public function remove(){
        return $this->session->remove('cart');
    }

    public function delete($id){
        $cart = $this->session->get('cart', []);

        unset($cart[$id]);
        return $this->session->set('cart', $cart);
    }

    public function decrease($id){
        $cart = $this->session->get('cart', []);

        if($cart[$id] > 1){
            $cart[$id]--;
        }
        else{
            unset($cart[$id]);
        }
        return $this->session->set('cart', $cart);
    }

    public function getFull(){
        $cartComplete = [];

        if($this->get()){
            foreach($this->get() as $id => $quantity){
                $productObject = $this->entityManager->getRepository(Product::class)->findOneById($id);
                if(!$productObject){
                    $this->delete($id);
                    continue;
                }
                $cartComplete[] = [
                    'product' => $productObject,
                    'quantity' => $quantity
                ];
            }
        }

        return $cartComplete;
    }
}
