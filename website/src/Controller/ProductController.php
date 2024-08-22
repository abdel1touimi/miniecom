<?php

namespace App\Controller;

use App\Service\ProductApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
  private $productApiService;

  public function __construct(ProductApiService $productApiService)
  {
    $this->productApiService = $productApiService;
  }

  #[Route('/', name: 'app_home')]
  public function index(): Response
  {
    return $this->render('product/index.html.twig');
  }

  #[Route('/api/products', name: 'app_products', methods: ['GET'])]
  public function getProducts(Request $request): Response
  {
    $sort = $request->query->get('sort', 'asc');
    $products = $this->productApiService->getProducts($sort);
    return $this->json($products);
  }

  #[Route('/api/products/categories', name: 'app_product_categories', methods: ['GET'])]
  public function getCategories(): Response
  {
    $categories = $this->productApiService->getCategories();
    return $this->json($categories);
  }

  #[Route('/api/products/category/{category}', name: 'app_products_by_category', methods: ['GET'])]
  public function getProductsByCategory(string $category, Request $request): Response
  {
    $sort = $request->query->get('sort', 'asc');
    $products = $this->productApiService->getProductsByCategory($category, $sort);
    return $this->json($products);
  }
}
