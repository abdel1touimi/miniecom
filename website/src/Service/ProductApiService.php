<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductApiService
{
  private $httpClient;
  private $apiBaseUrl;

  public function __construct(HttpClientInterface $httpClient)
  {
    $this->httpClient = $httpClient;
    $this->apiBaseUrl = 'https://fakestoreapi.com';
  }

  public function getProducts(string $sort = 'asc'): array
  {
    $response = $this->httpClient->request('GET', "{$this->apiBaseUrl}/products", [
      'query' => [
        'sort' => $sort,
      ],
    ]);
    return $response->toArray();
  }

  public function getCategories(): array
  {
    $response = $this->httpClient->request('GET', "{$this->apiBaseUrl}/products/categories");
    return $response->toArray();
  }

  public function getProductsByCategory(string $category, string $sort = 'asc'): array
  {
    $response = $this->httpClient->request('GET', "{$this->apiBaseUrl}/products/category/{$category}", [
      'query' => [
        'sort' => $sort,
      ],
    ]);

    return $response->toArray();
  }
}
