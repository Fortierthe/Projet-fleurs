<?php

namespace App\Controller;

use App\Classe\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AddressType;
use App\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AccountAddressController extends AbstractController
{

    private $entityManger;
    public function __construct(EntityManagerInterface $entityManger)
    {
        $this->entityManger = $entityManger;
    }

    #[Route('/compte/addresses', name: 'app_account_address')]
    public function index(): Response
    {
        return $this->render('account/address.html.twig');
    }


    #[Route('/compte/ajouter-une-adresse', name: 'app_account_address_add')]
    public function add(Cart $cart, Request $request): Response
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        if($form-> isSubmitted() && $form->isValid()){
            $address->setUser($this->getUser());
            $this->entityManger->persist($address);
            $this->entityManger->flush();
            if($cart->get()){
                return $this->redirectToRoute('app_order');
            }
            else{
                return $this->redirectToRoute('app_account_address');
            }
        }
        return $this->render('account/address_form.html.twig',[
            'form' => $form->createView()
        ]);
    }


    #[Route('/compte/modifier-une-adresse/{id}', name: 'app_account_address_edit')]
    public function edit(Request $request, $id): Response
    {
        $address = $this->entityManger->getRepository(Address::class)->findOneById($id);

        if(!$address || $address->getUser() != $this->getUser()){
            return $this->redirectToRoute('app_account_address');
        }

        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if($form-> isSubmitted() && $form->isValid()){
            // $address->setUser($this->getUser());
            // $this->entityManger->persist($address);
            $this->entityManger->flush();
            return $this->redirectToRoute('app_account_address');
        }
        return $this->render('account/address_form.html.twig',[
            'form' => $form->createView()
        ]);
    }



    #[Route('/compte/supprimer-une-adresse/{id}', name: 'app_account_address_delete')]
    public function delete( $id): Response
    {
        $address = $this->entityManger->getRepository(Address::class)->findOneById($id);

        if($address && $address->getUser() == $this->getUser()){
            $this->entityManger->remove($address);
            $this->entityManger->flush();
        }

        return $this->redirectToRoute('app_account_address');
    }
}

