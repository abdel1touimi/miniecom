import axios from 'axios';

export default {
  async getCart() {
    try {
      const response = await axios.get('/api/cart');
      return response.data;
    } catch (error) {
      console.error('Error fetching cart:', error);
      throw new Error('Failed to fetch cart. Please try again later.');
    }
  },

  async addToCart(product, quantity = 1) {
    try {
      const response = await axios.post('/api/cart/add', { product, quantity });
      return response.data;
    } catch (error) {
      console.error('Error adding to cart:', error);
      throw new Error('Failed to add product to cart. Please try again later.');
    }
  },

  async removeFromCart(productId) {
    try {
      const response = await axios.post('/api/cart/remove', { productId });
      return response.data;
    } catch (error) {
      console.error('Error removing from cart:', error);
      throw new Error('Failed to remove product from cart. Please try again later.');
    }
  },

  async clearCart() {
    try {
      const response = await axios.post('/api/cart/clear');
      return response.data;
    } catch (error) {
      console.error('Error clearing cart:', error);
      throw new Error('Failed to clear cart. Please try again later.');
    }
  }
};
