<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use App\Classe\Search;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/nos-produits', name: 'app_product')]
    public function index(Request $request): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        // dd($products);

        $search = new  Search();
        $form = $this->createForm(SearchType::class,$search);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $search = $form->getData();
            $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
            // dd($search);
        }
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' =>$form->createview(),
        ]);
    }

    #[Route('/produit/{slug}', name: 'product')]
    public function show($slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

        if(!$product) {
            return $this->redirectToRoute('app_product');
        }
        // dd($products);
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
