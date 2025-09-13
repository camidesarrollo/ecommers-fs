import { createRouter, createWebHistory } from 'vue-router';

// Importamos las páginas
import Home from '../presentation/pages/Home.vue';
import About from '../presentation/pages/About.vue';
import Contact from '../presentation/pages/Contact.vue';
import PreguntasFrecuentes from '../presentation/pages/PreguntasFrecuentes.vue';
import CartPage from '../presentation/pages/CartPage.vue';
import UserProfile from '../presentation/pages/UserProfile.vue';
import FavoritesPage from '../presentation/pages/FavoritesPage.vue';
import ProductoList from '../presentation/pages/ProductoList.vue';

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/about', name: 'About', component: About },
  { path: '/contact', name: 'Contact', component: Contact },
  { path: '/preguntasFrecuentes', name: 'PreguntasFrecuentes', component: PreguntasFrecuentes },
  { path: '/profile', name: 'UserProfile', component: UserProfile },
  { path: '/favorites', name: 'FavoritesPage', component: FavoritesPage },
  { path: '/productoList', name: 'ProductoList', component: ProductoList },
  { path: '/carrito', name: 'CartPage', component: CartPage },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
