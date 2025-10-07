// router/index.js
import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '../presentation/pages/Login.vue'
import RegisterPage from '../presentation/pages/Register.vue'
import ForgotPassword from '../presentation/pages/ForgotPassword.vue'
import HomePage from '../presentation/pages/Home.vue'
import ProductoList from '../presentation/pages/ProductoList.vue'
import Producto from '../presentation/pages/DetalleProducto.vue'
import About from '../presentation/pages/About.vue'
import PreguntasFrecuentes from '../presentation/pages/PreguntasFrecuentes.vue'
import Contact from '../presentation/pages/Contact.vue'
import UserProfile from '../presentation/pages/UserProfile.vue'
const routes = [
  // Rutas SIN layout (páginas de autenticación)
  {
    path: '/login',
    name: 'Login',
    component: LoginPage,
    meta: { 
      layout: 'none', // Sin layout
      requiresAuth: false,
      title: 'Iniciar Sesión'
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: RegisterPage,
    meta: { 
      layout: 'none', // Sin layout
      requiresAuth: false,
      title: 'Registrarse'
    }
  },
  {
    path: '/forgot-password',
    name: 'ForgotPassword',
    component: ForgotPassword,
    meta: { 
      layout: 'none', // Sin layout
      requiresAuth: false,
      title: 'Recuperar Contraseña'
    }
  },

  // Rutas CON layout público (páginas principales)
  {
    path: '/',
    name: 'Home',
    component: HomePage,
    meta: { 
      layout: 'public', // Con PublicLayout
      requiresAuth: false,
      title: 'Inicio - Secos y Saludables JPJ'
    }
  },
  {
    path: '/productos',
    name: 'Products',
    component: ProductoList,
    meta: { 
      layout: 'public', // Con PublicLayout
      requiresAuth: false,
      title: 'Productos'
    }
  },
  {
    path: '/producto',
    name: 'Product',
    component: Producto,
    meta: { 
      layout: 'public', // Con PublicLayout
      requiresAuth: false,
      title: 'Producto'
    }
    
  },
  
  {
    path: '/about',
    name: 'About',
    component: About,
    meta: { 
      layout: 'public', // Con PublicLayout
      requiresAuth: false,
      title: 'Sobre Nosotros'
    }
    
  },
  {
    path: '/paq',
    name: 'PreguntasFrecuentes',
    component: PreguntasFrecuentes,
    meta: { 
      layout: 'public', // Con PublicLayout
      requiresAuth: false,
      title: 'Preguntas Frecuentes'
    }
    
  },
    {
    path: '/contacto',
    name: 'Contacto',
    component: Contact,
    meta: { 
      layout: 'public', // Con PublicLayout
      requiresAuth: false,
      title: 'Contacto'
    }
    
  },
  {
    path: '/perfil',
    name: 'UserProfile',
    component: UserProfile,
    meta: { 
      layout: 'public', // Con PublicLayout
      requiresAuth: false,
      title: 'Mi perfil'
    }
    
  }
  
  // {
  //   path: '/dashboard',
  //   name: 'Dashboard',
  //   component: () => import('@/views/DashboardPage.vue'),
  //   meta: { 
  //     layout: 'public', // Con PublicLayout (o 'admin' si tienes AdminLayout)
  //     requiresAuth: true,
  //     title: 'Dashboard'
  //   }
  // },

  // // Ruta 404
  // {
  //   path: '/:pathMatch(.*)*',
  //   name: 'NotFound',
  //   component: () => import('@/views/NotFoundPage.vue'),
  //   meta: { 
  //     layout: 'public',
  //     title: 'Página no encontrada'
  //   }
  // }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    }
    return { top: 0 }
  }
})

// Navigation guards
router.beforeEach((to, from, next) => {
  // Actualizar título de la página
  document.title = to.meta.title || 'Secos y Saludables JPJ'

  // Verificar autenticación
  const isAuthenticated = checkAuthStatus() // Tu función de verificación
  
  if (to.meta.requiresAuth && !isAuthenticated) {
    next('/login')
  } else if ((to.name === 'Login' || to.name === 'Register') && isAuthenticated) {
    next('/dashboard')
  } else {
    next()
  }
})

// Función auxiliar para verificar estado de autenticación
function checkAuthStatus() {
  // Implementa tu lógica de verificación aquí
  // Por ejemplo: verificar token en localStorage, Vuex/Pinia, etc.
  const token = localStorage.getItem('auth_token')
  return !!token
}

export default router