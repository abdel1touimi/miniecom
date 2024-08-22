<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
  #[Route('/cart', name: 'cart_page', methods: ['GET'])]
  public function cartPage(): Response
  {
    return $this->render('cart/index.html.twig');
  }

  #[Route('/api/cart', name: 'cart_get', methods: ['GET'])]
  public function getCart(SessionInterface $session): JsonResponse
  {
    $cart = $session->get('cart', []);
    return $this->json($cart);
  }

  #[Route('/api/cart/add', name: 'cart_add', methods: ['POST'])]
  public function addToCart(Request $request, SessionInterface $session): JsonResponse
  {
    $data = json_decode($request->getContent(), true);
    $product = $data['product'];
    $quantity = $data['quantity'] ?? 1;

    $cart = $session->get('cart', []);

    if (isset($cart[$product['id']])) {
      $cart[$product['id']]['quantity'] += $quantity;
    } else {
      $cart[$product['id']] = [
        'id' => $product['id'],
        'title' => $product['title'],
        'price' => $product['price'],
        'image' => $product['image'],
        'quantity' => $quantity,
      ];
    }

    $session->set('cart', $cart);

    return $this->json(['message' => 'Product added to cart', 'cart' => $cart]);
  }

  #[Route('/api/cart/remove', name: 'cart_remove', methods: ['POST'])]
  public function removeFromCart(Request $request, SessionInterface $session): JsonResponse
  {
    $data = json_decode($request->getContent(), true);
    $productId = $data['productId'];

    $cart = $session->get('cart', []);

    if (isset($cart[$productId])) {
      unset($cart[$productId]);
      $session->set('cart', $cart);
      return $this->json(['message' => 'Product removed from cart', 'cart' => $cart]);
    }

    return $this->json(['message' => 'Product not found in cart'], 404);
  }

  #[Route('/api/cart/clear', name: 'cart_clear', methods: ['POST'])]
  public function clearCart(SessionInterface $session): JsonResponse
  {
    $session->set('cart', []);
    return $this->json(['message' => 'Cart cleared']);
  }
}
