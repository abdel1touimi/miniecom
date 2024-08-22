<template>
  <nav class="navbar">
    <div class="navbar-container">
      <a href="/" class="navbar-logo">
        🛍️ Mini E-commerce
      </a>
      <ul class="navbar-menu">
        <li class="navbar-item">
          <a href="/" class="navbar-link">Products</a>
        </li>
        <li class="navbar-item">
          <a href="/cart" class="navbar-link">Cart</a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar'
}
</script>

<style>
.navbar {
  background-color: #333;
  color: white;
  padding: 1rem 0;
}

.navbar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
}

.navbar-logo {
  font-size: 1.5rem;
  font-weight: bold;
  color: white;
  text-decoration: none;
}

.navbar-menu {
  list-style-type: none;
  display: flex;
  margin: 0;
  padding: 0;
}

.navbar-item {
  margin-left: 1rem;
}

.navbar-link {
  color: white;
  text-decoration: none;
  font-size: 1rem;
  transition: color 0.3s ease;
}

.navbar-link:hover {
  color: #4CAF50;
}
</style>
