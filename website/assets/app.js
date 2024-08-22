import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Navbar from './components/Navbar.vue';
import ProductList from './components/ProductList.vue';
import CartPage from './components/CartPage.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: ProductList },
        { path: '/cart', component: CartPage }
    ]
});

const navbarApp = createApp(Navbar);
navbarApp.mount('#navbar');

const app = createApp({
    template: '<router-view></router-view>'
});

app.use(router);
app.mount('#app');
