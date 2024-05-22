<?php
 
// // namespace App\Controller;

// // use App\Classe\Cart;
// // use App\Entity\Order;
// // use App\Entity\commande_paye;
// // use App\Entity\OrderDetails;
// // use App\Entity\User;
// // use App\Form\OrderType;
// // use DateTime;
// // use DateTimeImmutable;
// // use Doctrine\ORM\EntityManagerInterface;
// // use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// // use Symfony\Component\HttpFoundation\Request;
// // use Symfony\Component\HttpFoundation\Response;
// // use Symfony\Component\Routing\Annotation\Route;
// // use Symfony\Component\Mailer\MailerInterface;
// // use Symfony\Component\Mime\Email;


// // class CommandePayeController extends AbstractController
// // {
// //     private $entityManager;

// //         public function __construct(EntityManagerInterface $entityManager){
// //             $this->entityManager = $entityManager;
// //         }

// //     #[Route('/commande/paye', name: 'app_commande_paye')]
// //     public function app_commande_paye(Cart $cart, Request $request, MailerInterface $mailer): Response
// //     {
// //         $form = $this->createForm(OrderType::class, null, [
// //             'user' => $this->getUser()
// //         ]);
// //         $form->handleRequest($request);
// //         // $date = new DateTime();
// //         $date = new DateTimeImmutable();
// //         //$formattedDate = $date->format('Y-m-d H:i:s');

// //         $carriers = $form->get('carriers')->getData();
// //         $delivery = $form->get('addresses')->getData();
// //         $delivery_content = $delivery->getFirstname().' '.$delivery->getLastname();
// //         $delivery_content = $delivery->getPhone();
// //         if( $delivery->getCompany() ){
// //             $delivery_content .= '<br/>'.$delivery->getCompany();
// //         }
// //         $delivery_content .= '<br/>'.$delivery->getAddress();
// //         $delivery_content .= '<br/>'.$delivery->getPostal().' '.$delivery->getCountry();


// //         // Enregistrer ma commande Order()
// //         $order = new Order();
// //         $order->setUser($this->getUser());
// //         $order->setCreatedAt($date);
// //         $order->setCarrierName($carriers->getName());
// //         $order->setCarrierPrice($carriers->getPrice());
// //         $order->setDelivery($delivery_content);
// //         $order->setIsPaid(0);

// //         $this->entityManager->persist($order);


// //         // Enregistrer mes produits OrderDetails()
// //         foreach($cart->getFull() as $product){
// //             $orderDetails = new OrderDetails();
// //             // $orderDetails->setMyOrder($this->getUser());
// //             $orderDetails->setMyOrder($order);
// //             $orderDetails->setProduct($product['product']->getName());
// //             $orderDetails->setQuantity($product['quantity']);
// //             $orderDetails->setPrice($product['product']->getPrice());
// //             $orderDetails->setTotal($product['product']->getPrice() * $product['quantity']);
// //             $this->entityManager->persist($orderDetails);
// //         }

// //         $this->entityManager->flush();
// //         print_r( $this->entityManager);
        
// //         $email = (new Email())
// //             ->from('flowerstore@laposte.net')
// //             ->to('fortierthe@cy-tech.fr')
// //             ->subject('Sigykujet de l\'email')
// //             ->text('{$cart}dzd{$request}')
// //             ->html('<p>CoéifbuiabufiaelbflaiuefbaliufbuifailzfubzuiabML</p>');

// //         try {
// //             $mailer->send($email);
// //         } catch (TransportExceptionInterface $e) {
// //             // some error prevented the email sending; display an
// //             // error message or try to resen
// //         }
// //         return $this->render('commande_paye/index.html.twig', [
// //             'controller_name' => 'CommandePayeController',
// //         ]);
// //     }
// //}

// namespace App\Controller;

// //A faire, changer quand la commande est envoyé a la bdd ce qui me permettra de faire le mail en même temps sachant que la méthode de base marche. A faire un form comme la page précdente.

// use App\Classe\Cart;
// use App\Entity\Order;
// use App\Entity\commande_paye;
// use App\Entity\OrderDetails;
// use App\Classe\Carriers;
// use App\Entity\User;
// use App\Form\OrderType;
// use DateTime;
// use DateTimeImmutable;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Mailer\MailerInterface;
// use Symfony\Component\Mime\Email;

// class CommandePayeController extends AbstractController
// {

//     private $entityManager;

//     public function __construct(EntityManagerInterface $entityManager)
//     {
//         $this->entityManager = $entityManager;
//     }

//     /**
//      * 1ère étape du tunnel d'achat
//      * Choix de l'adresse de livraison et du transporteur 
//      */

//     #[Route('/commande/recapitulatif', name: 'app_order_recap', methods: ['POST'])]
//     public function add(Cart $cart, Request $request): Response
//     {

//         $form = $this->createForm(OrderType::class, null, [
//             'user' => $this->getUser()
//         ]);
//         $form->handleRequest($request);

//         $carriers = null;

//         if($form->isSubmitted() && $form->isValid()){
//             // $date = new DateTime();
//             $date = new DateTimeImmutable();
//             //$formattedDate = $date->format('Y-m-d H:i:s');

//             $carriers = $form->get('carriers')->getData();
//             $delivery = $form->get('addresses')->getData();
//             $delivery_content = $delivery->getFirstname().' '.$delivery->getLastname();
//             $delivery_content = $delivery->getPhone();
//             if( $delivery->getCompany() ){
//                 $delivery_content .= '<br/>'.$delivery->getCompany();
//             }
//             $delivery_content .= '<br/>'.$delivery->getAddress();
//             $delivery_content .= '<br/>'.$delivery->getPostal().' '.$delivery->getCountry();


//             // Enregistrer ma commande Order()
//             $order = new Order();
//             $order->setUser($this->getUser());
//             $order->setCreatedAt($date);
//             $order->setCarrierName($carriers->getName());
//             $order->setCarrierPrice($carriers->getPrice());
//             $order->setDelivery($delivery_content);
//             $order->setIsPaid(0);

//             $this->entityManager->persist($order);


//             // Enregistrer mes produits OrderDetails()
//             foreach($cart->getFull() as $product){

//                 $orderDetails = new OrderDetails();
//                 // $orderDetails->setMyOrder($this->getUser());
//                 $orderDetails->setMyOrder($order);
//                 $orderDetails->setProduct($product['product']->getName());
//                 $orderDetails->setQuantity($product['quantity']);
//                 $orderDetails->setPrice($product['product']->getPrice());
//                 $orderDetails->setTotal($product['product']->getPrice() * $product['quantity']);
//                 $this->entityManager->persist($orderDetails);
//             }
//             $this->entityManager->flush();
//             $nom = "test";
//             print_r($delivery_content);
//             return $this->render('commande_paye/add.html.twig',[
//                 'cart' => $cart->getFull(),
//                 'carrier' => $carriers,
//                 'delivery' => $delivery_content,
//                 'nom' => $nom,
//                 'form' => $form->createView()

//             ]);
//         }
        
//         return $this->redirectToRoute('app_cart');
//     }


//     #[Route('/commande/paye', name: 'app_commande_paye')]
//     public function app_commande_paye(Cart $cart, Request $request, MailerInterface $mailer): Response
//     {
//         $carriers = $request->query->get('carriers');
//         print_r($carriers);
//         $delivery = $request->query->get('delivery');
//         print_r($delivery);
//         $products = json_decode($request->query->get('product'), true);       
//         print_r($products[0]['product']['name']);
//         $date = new DateTime();
//         $date = new DateTimeImmutable();
//         $formattedDate = $date->format('Y-m-d H:i:s');

//         // Enregistrer ma commande Order()
//         $order = new Order();
        

//         $this->entityManager->persist($order);
//         print_r("pojihugkojin <br>");

//         foreach($products as $product){
//             print_r("<br>");
//             //    $orderDetails = new OrderDetails();
//             //    // $orderDetails->setMyOrder($this->getUser());
//             //    $orderDetails->setMyOrder($order);
//             //    $orderDetails->setProduct($product['product']['name']);
//             //    $orderDetails->setQuantity($product['quantity']);
//             //    $orderDetails->setPrice($product['product']->getPrice());
//             //    $orderDetails->setTotal($product['product']->getPrice() * $product['quantity']);
//             //     print_r($orderDetails);
//             }

//         //$carriers = $form->get('carriers')->getData();
//         //$delivery = $form->get('addresses')->getData();
//         //$delivery_content = $delivery->getFirstname().' '.$delivery->getLastname();
//         //$delivery_content = $delivery->getPhone();
//         //if( $delivery->getCompany() ){
//         //    $delivery_content .= '<br/>'.$delivery->getCompany();
//         //}
//         //$delivery_content .= '<br/>'.$delivery->getAddress();
//         //$delivery_content .= '<br/>'.$delivery->getPostal().' '.$delivery->getCountry();
// //
// //
//         //// Enregistrer ma commande Order()
//         //$order = new Order();
//         //$order->setUser($this->getUser());
//         //$order->setCreatedAt($date);
//         //$order->setCarrierName($carriers->getName());
//         //$order->setCarrierPrice($carriers->getPrice());
//         //$order->setDelivery($delivery_content);
//         //$order->setIsPaid(0);
// //
//         //$this->entityManager->persist($order);
// //
// //
//         //// Enregistrer mes produits OrderDetails()
//         //foreach($cart->getFull() as $product){
//         //    $orderDetails = new OrderDetails();
//         //    // $orderDetails->setMyOrder($this->getUser());
//         //    $orderDetails->setMyOrder($order);
//         //    $orderDetails->setProduct($product['product']->getName());
//         //    $orderDetails->setQuantity($product['quantity']);
//         //    $orderDetails->setPrice($product['product']->getPrice());
//         //    $orderDetails->setTotal($product['product']->getPrice() * $product['quantity']);
//         //    $this->entityManager->persist($orderDetails);
//         //}
// //
//         //$this->entityManager->flush();
//         //print_r( $this->entityManager);
//         //
//         $email = (new Email())
//             ->from('flowerstore@laposte.net')
//             ->to('fortierthe@cy-tech.fr')
//             ->subject('Sigykujet de l\'email')
//             ->text('{$cart}dzd{$request}')
//             ->html('<p>CoéifbuiabufiaelbflaiuefbaliufbuifailzfubzuiabML</p>');

//         try {
//             $mailer->send($email);
//         } catch (TransportExceptionInterface $e) {
//             // some error prevented the email sending; display an
//             // error message or try to resen
//         }
//         return $this->render('commande_paye/index.html.twig', [
//             'controller_name' => 'CommandePayeController',
//             'carriers' => $carriers,
//             'delivery' => $delivery,
//             'products' => $products,

//         ]);
//     }
// }

//  

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\commande_paye;
use App\Entity\OrderDetails;
use App\Classe\Carriers;
use App\Entity\User;
use App\Form\OrderType;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class CommandePayeController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * 1ère étape du tunnel d'achat
     * Choix de l'adresse de livraison et du transporteur 
     */

    #[Route('/commande/recapitulatif', name: 'app_order_recap', methods: ['POST'])]
    public function add(Cart $cart, Request $request): Response
    {

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);
        $form->handleRequest($request);

        $carriers = null;

        if($form->isSubmitted() && $form->isValid()){
            // $date = new DateTime();
            $date = new DateTimeImmutable();
            //$formattedDate = $date->format('Y-m-d H:i:s');

            $carriers = $form->get('carriers')->getData();
            $delivery = $form->get('addresses')->getData();
            $delivery_content = $delivery->getFirstname().' '.$delivery->getLastname();
            $delivery_content = $delivery->getPhone();
            if( $delivery->getCompany() ){
                $delivery_content .= '<br/>'.$delivery->getCompany();
            }
            $delivery_content .= '<br/>'.$delivery->getAddress();
            $delivery_content .= '<br/>'.$delivery->getPostal().' '.$delivery->getCountry();


            // Enregistrer ma commande Order()
            $order = new Order();
            $order->setUser($this->getUser());
            $order->setCreatedAt($date);
            $order->setCarrierName($carriers->getName());
            $order->setCarrierPrice($carriers->getPrice());
            $order->setDelivery($delivery_content);
            $order->setIsPaid(0);

            $this->entityManager->persist($order);


            // Enregistrer mes produits OrderDetails()
            foreach($cart->getFull() as $product){

                $orderDetails = new OrderDetails();
                // $orderDetails->setMyOrder($this->getUser());
                $orderDetails->setMyOrder($order);
                $orderDetails->setProduct($product['product']->getName());
                $orderDetails->setQuantity($product['quantity']);
                $orderDetails->setPrice($product['product']->getPrice());
                $orderDetails->setTotal($product['product']->getPrice() * $product['quantity']);
                $this->entityManager->persist($orderDetails);
            }
            $this->entityManager->flush();
            $nom = "test";
            return $this->render('commande_paye/add.html.twig',[
                'cart' => $cart->getFull(),
                'carrier' => $carriers,
                'delivery' => $delivery_content,
                'nom' => $nom,
                'form' => $form->createView()

            ]);
        }
        
        return $this->redirectToRoute('app_cart');
    }


    #[Route('/commande/paye', name: 'app_commande_paye')]
    public function app_commande_paye(Cart $cart, Request $request,MailerInterface $mailer): Response
    {
        
        $carriers = $request->query->get('carriers');
        $carriers = explode('[br]', $carriers);
        $delivery = $request->query->get('delivery');
        $date = new DateTime();
        $date = new DateTimeImmutable();
        $formattedDate = $date->format('Y-m-d H:i:s');
        $products = json_decode($request->query->get('products'), true);
        $name = $request->query->get('name');
        $usermail = $request->query->get('usermail');
        $total = $request->query->get('total');
    
    $contentMail = $this->renderView('commande_paye/email.html.twig', [
        // Passer les variables nécessaires à votre modèle Twig
        'date' => $formattedDate,
        'invoiceNumber' => '123456',
        'recipient' => $name,
        'products' => $products,
        'carriers' => $carriers,
        'total' => $total,
    ]);

    /*
    return $this->render('commande_paye/email.html.twig', [
        // Passer les variables nécessaires à votre modèle Twig
        'date' => $formattedDate,
        'invoiceNumber' => '123456',
        'recipient' => $name,
        'products' => $products,
        'carriers' => $carriers,
        'total' => $total,
    ]);
    */

    
    $email = (new Email())
        ->from('flowerstore@laposte.net')
        ->to($usermail)
        ->cc('flowerstore@laposte.net')
        ->bcc('fortierthe@cy-tech.fr')
        ->subject('Facture FlowerStore')
        ->text('')
        ->html($contentMail);

    try {
        
        $mailer->send($email);
    } catch (TransportExceptionInterface $e) {
        // some error prevented the email sending; display an
        // error message or try to resen
    }
    
    $cart->remove();
    return $this->render('commande_paye/index.html.twig');
    }
}



