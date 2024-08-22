<template>
  <div class="product-page">
    <h1 class="page-title">Our Products</h1>
    <div class="filters">
      <select v-model="selectedCategory" @change="loadProducts" class="filter-select">
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category" :value="category">
          {{ category }}
        </option>
      </select>
      <select v-model="sortOrder" @change="loadProducts" class="filter-select">
        <option value="asc">Price: Low to High</option>
        <option value="desc">Price: High to Low</option>
      </select>
    </div>
    <div class="product-grid">
      <div v-for="product in products" :key="product.id" class="product-card">
        <img :src="product.image" :alt="product.title" class="product-image">
        <div class="product-info">
          <h3 class="product-title">{{ product.title }}</h3>
          <p class="product-price">${{ product.price.toFixed(2) }}</p>
          <button @click="addToCart(product)" class="add-to-cart-btn">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProductService from '../services/ProductService';
import CartService from '../services/CartService';

export default {
  data() {
    return {
      products: [],
      categories: [],
      selectedCategory: '',
      sortOrder: 'asc',
    }
  },
  mounted() {
    this.loadCategories();
    this.loadProducts();
  },
  methods: {
    async loadCategories() {
      this.categories = await ProductService.getCategories();
    },
    async loadProducts() {
      if (this.selectedCategory) {
        this.products = await ProductService.getProductsByCategory(
          this.selectedCategory,
          this.sortOrder
        );
      } else {
        this.products = await ProductService.getProducts(this.sortOrder);
      }
    },
    async addToCart(product) {
      try {
        await CartService.addToCart(product);
        console.log('Added to cart:', product);
      } catch (error) {
        console.error('Failed to add product to cart:', error);
      }
    }
  }
}
</script>

<style>
.product-page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  font-family: Arial, sans-serif;
}

.page-title {
  text-align: center;
  color: #333;
  margin-bottom: 30px;
}

.filters {
  display: flex;
  justify-content: center;
  margin-bottom: 30px;
}

.filter-select {
  margin: 0 10px;
  padding: 8px 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: white;
  font-size: 14px;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 30px;
  margin-bottom: 30px;
}

.product-card {
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  transition: box-shadow 0.3s ease;
}

.product-card:hover {
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.product-image {
  width: 100%;
  height: 200px;
  object-fit: contain;
  background-color: #f9f9f9;
}

.product-info {
  padding: 15px;
}

.product-title {
  font-size: 16px;
  margin: 0 0 10px;
  color: #333;
  height: 40px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

.product-price {
  font-size: 18px;
  font-weight: bold;
  color: #e44d26;
  margin: 0 0 15px;
}

.add-to-cart-btn {
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.add-to-cart-btn:hover {
  background-color: #45a049;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
}

.pagination-btn {
  padding: 8px 16px;
  background-color: #008CBA;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.pagination-btn:hover:not(:disabled) {
  background-color: #007B9A;
}

.pagination-btn:disabled {
  background-color: #ddd;
  cursor: not-allowed;
}

.page-indicator {
  margin: 0 15px;
  font-size: 14px;
}
</style>
