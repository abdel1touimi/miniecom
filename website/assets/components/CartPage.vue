<template>
  <div class="cart-page">
    <h1 class="page-title">Your Shopping Cart</h1>
    <div v-if="Object.keys(cart).length === 0" class="empty-cart">
      Your cart is empty.
    </div>
    <div v-else>
      <ul class="cart-items">
        <li v-for="item in Object.values(cart)" :key="item.id" class="cart-item">
          <img :src="item.image" :alt="item.title" class="cart-item-image">
          <div class="cart-item-details">
            <h3 class="cart-item-title">{{ item.title }}</h3>
            <p class="cart-item-price">Price: ${{ item.price.toFixed(2) }}</p>
            <p class="cart-item-quantity">Quantity: {{ item.quantity }}</p>
          </div>
          <button @click="removeFromCart(item.id)" class="remove-btn">Remove</button>
        </li>
      </ul>
      <div class="cart-summary">
        <h3 class="cart-total">Total: ${{ cartTotal.toFixed(2) }}</h3>
        <button @click="clearCart" class="clear-btn">Clear Cart</button>
        <button @click="checkout" class="checkout-btn">Proceed to Checkout</button>
      </div>
    </div>
  </div>
</template>

<script>
import CartService from '../services/CartService';

export default {
  data() {
    return {
      cart: {}
    }
  },
  computed: {
    cartTotal() {
      return Object.values(this.cart).reduce((total, item) => total + item.price * item.quantity, 0);
    }
  },
  methods: {
    async loadCart() {
      try {
        this.cart = await CartService.getCart();
      } catch (error) {
        console.error('Failed to load cart:', error);
        // Handle error (e.g., show error message to user)
      }
    },
    async removeFromCart(productId) {
      try {
        await CartService.removeFromCart(productId);
        this.loadCart(); // Reload the cart after removing an item
      } catch (error) {
        console.error('Failed to remove item from cart:', error);
        // Handle error
      }
    },
    async clearCart() {
      try {
        await CartService.clearCart();
        this.cart = {};
      } catch (error) {
        console.error('Failed to clear cart:', error);
        // Handle error
      }
    },
    checkout() {
      // Implement checkout functionality
      console.log('Proceeding to checkout');
    }
  },
  mounted() {
    this.loadCart();
  }
}
</script>

<style>
.cart-page {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  font-family: Arial, sans-serif;
}

.page-title {
  text-align: center;
  color: #333;
  margin-bottom: 30px;
}

.empty-cart {
  text-align: center;
  font-size: 18px;
  color: #666;
  margin-top: 50px;
}

.cart-items {
  list-style-type: none;
  padding: 0;
}

.cart-item {
  display: flex;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
}

.cart-item-image {
  width: 100px;
  height: 100px;
  object-fit: contain;
  margin-right: 20px;
  background-color: #f9f9f9;
}

.cart-item-details {
  flex-grow: 1;
}

.cart-item-title {
  font-size: 18px;
  margin: 0 0 10px;
  color: #333;
}

.cart-item-price, .cart-item-quantity {
  font-size: 14px;
  color: #666;
  margin: 5px 0;
}

.remove-btn {
  padding: 8px 12px;
  background-color: #e74c3c;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.remove-btn:hover {
  background-color: #c0392b;
}

.cart-summary {
  text-align: right;
  margin-top: 30px;
}

.cart-total {
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

.checkout-btn {
  padding: 12px 24px;
  background-color: #2ecc71;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.checkout-btn:hover {
  background-color: #27ae60;
}

.clear-btn {
  padding: 8px 16px;
  background-color: #e74c3c;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-right: 10px;
}

.clear-btn:hover {
  background-color: #c0392b;
}
</style>
