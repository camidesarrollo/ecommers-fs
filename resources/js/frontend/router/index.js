// router/index.js
import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '../presentation/pages/Login.vue'
import RegisterPage from '../presentation/pages/Register.vue'
// import ForgotPasswordPage from '../presentation/pages/ForgotPasswordPage.vue'
import HomePage from '../presentation/pages/Home.vue'
import ProductoList from '../presentation/pages/ProductoList.vue'

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
  // {
  //   path: '/forgot-password',
  //   name: 'ForgotPassword',
  //   component: ForgotPasswordPage,
  //   meta: { 
  //     layout: 'none', // Sin layout
  //     requiresAuth: false,
  //     title: 'Recuperar Contraseña'
  //   }
  // },

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