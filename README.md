# 🛍️ Mini E-commerce Product Gallery

This project is a simplified MVP demonstrating basic e-commerce functionalities, including backend-frontend integration and interaction with an external API.

## Setup Instructions

To set up and run the project, follow these steps:

1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Run the following command to start the application:

   ```
   make start
   ```

   This command will set up the necessary dependencies and start the development server.

## Implementation Overview

This Mini E-commerce Product Gallery is built using a fullstack approach with Symfony for the backend and Vue.js for the frontend. Here's a brief overview of the implementation:

### Backend (Symfony)

- `ProductApiService`: Handles communication with the Fake Store API to fetch product data.
- `ProductController`: Exposes API endpoints for the frontend to consume, including routes for fetching all products, categories, and products by category.
- `CartController`: Exposes API endpoints for the frontend to interact with the shopping cart, including adding and removing items from the cart.

### Frontend (Vue.js)

- `ProductList.vue`: Displays the list of products fetched from the backend.
- `CartPage.vue`: Implements the shopping cart functionality and displays the cart contents.
- `Navbar.vue`: Provides navigation between the product list and cart pages.
- `ProductService.js`: Manages API calls to the backend for product-related data.
- `CartService.js`: Manages cart-related data and API calls to the backend.

## User Story 2 Implementation

For this MVP, we implemented the **Basic Cart** variation of User Story 2. This includes:

- Ability to add products to the cart
- Viewing the contents of the cart
- Removing items from the cart
- Displaying the total price of items in the cart
