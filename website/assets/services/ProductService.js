import axios from 'axios';

export default {
  async getProducts(sort = 'asc') {
    try {
      const response = await axios.get(`/api/products?sort=${sort}`);
      return response.data;
    } catch (error) {
      console.error('Error fetching products:', error);
      throw new Error('Failed to fetch products. Please try again later.');
    }
  },

  async getCategories() {
    try {
      const response = await axios.get('/api/products/categories');
      return response.data;
    } catch (error) {
      console.error('Error fetching categories:', error);
      throw new Error('Failed to fetch categories. Please try again later.');
    }
  },

  async getProductsByCategory(category, sort = 'asc') {
    try {
      const response = await axios.get(`/api/products/category/${category}?sort=${sort}`);
      return response.data;
    } catch (error) {
      console.error('Error fetching products by category:', error);
      throw new Error('Failed to fetch products for this category. Please try again later.');
    }
  }
}
