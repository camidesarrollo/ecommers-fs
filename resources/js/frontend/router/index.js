import { createRouter, createWebHistory } from 'vue-router';
import Home from '../presentation/pages/Home.vue';
import About from '../presentation/pages/About.vue';
import Contact from '../presentation/pages/Contact.vue';
import PreguntasFrecuentes from '../presentation/pages/PreguntasFrecuentes.vue';
import CartPage from '../presentation/pages/CartPage.vue';
import UserProfile from '../presentation/pages/UserProfile.vue';
import FavoritesPage from '../presentation/pages/FavoritesPage.vue';
import ProductoList from '../presentation/pages/ProductoList.vue';

const routes = [
  { path: '/', name: 'Home', component: Home, meta: { layout: 'public' } },
  { path: '/about', name: 'About', component: About, meta: { layout: 'public' } },
  { path: '/contact', name: 'Contact', component: Contact, meta: { layout: 'public' } },
  { path: '/preguntasFrecuentes', name: 'PreguntasFrecuentes', component: PreguntasFrecuentes, meta: { layout: 'public' } },
  { path: '/profile', name: 'UserProfile', component: UserProfile, meta: { layout: 'public' } },
  { path: '/favorites', name: 'FavoritesPage', component: FavoritesPage, meta: { layout: 'public' } },
  { path: '/productoList', name: 'ProductoList', component: ProductoList, meta: { layout: 'public' } },
  { path: '/carrito', name: 'CartPage', component: CartPage, meta: { layout: 'public' } },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
