<template>
  <header class="sticky top-0 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center p-4">

      <!-- Logo -->
      <div class="flex items-center gap-3">
        <div class="rounded-full p-2 bg-gradient-to-br from-yellow-700 to-yellow-500 text-white text-xl animate-bounce">
          <img src="/public/img/fbe92c76-59d0-4525-a1fe-8e06a4c98dbd2.PNG" alt="" class="w-10 h-10" />
        </div>
        <span class="font-bold text-xl text-gray-800">Secos y saludables JPJ</span>
      </div>

      <!-- Botones de acción -->
      <div class="flex items-center gap-3 relative">
        <!-- Buscar -->
        <div class="relative">
          <button @click="toggleSearch" class="text-gray-700 text-2xl relative z-20">
            <font-awesome-icon :icon="['fas', 'search']" />
          </button>

          <!-- Input animado -->
          <transition name="fade-scale">
            <input v-if="searchOpen" v-model="query" type="text" placeholder="Buscar productos..." class="absolute right-0 top-0 mt-10 w-64 md:w-80 px-4 py-2 rounded-lg 
                     bg-white/95 text-gray-800 border-2 border-transparent shadow-lg
                     focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 
                     focus:ring-opacity-50 transition-all duration-300 ease-in-out z-10" @keyup.enter="submitSearch"
              autofocus />
          </transition>
        </div>

        <!-- Usuario/Login -->
        <div class="relative">
          <button @click="toggleUser" class="text-gray-700 text-2xl relative">
            <font-awesome-icon v-if="!isLoggedIn" :icon="['fas', 'user']" />
            <img v-else :src="user.avatar" :alt="user.name" class="w-8 h-8 rounded-full object-cover border-2 border-yellow-400">
          </button>

          <!-- Dropdown del usuario -->
          <transition name="fade">
            <div v-if="userOpen"
              class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden">
              
              <!-- Usuario no logueado -->
              <div v-if="!isLoggedIn" class="p-4">
                <div class="text-center mb-4">
                  <font-awesome-icon :icon="['fas', 'user-circle']" class="text-4xl text-gray-400 mb-2" />
                  <p class="text-gray-600 text-sm">¡Inicia sesión para acceder a tu cuenta!</p>
                </div>
                <div class="space-y-2">
                  <button @click="login" class="w-full bg-yellow-400 text-white px-4 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
                    Iniciar Sesión
                  </button>
                  <button @click="register" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Registrarse
                  </button>
                </div>
              </div>

              <!-- Usuario logueado -->
              <div v-else class="p-4">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                  <img :src="user.avatar" :alt="user.name" class="w-12 h-12 rounded-full object-cover">
                  <div>
                    <p class="font-semibold text-gray-800">{{ user.name }}</p>
                    <p class="text-sm text-gray-500">{{ user.email }}</p>
                  </div>
                </div>
                <div class="space-y-2">
                  <a href="/perfil" class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 transition text-gray-700">
                    <font-awesome-icon :icon="['fas', 'user']" class="text-sm" />
                    Mi Perfil
                  </a>
                  <a href="/pedidos" class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 transition text-gray-700">
                    <font-awesome-icon :icon="['fas', 'box']" class="text-sm" />
                    Mis Pedidos
                  </a>
                  <a href="/favoritos" class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 transition text-gray-700">
                    <font-awesome-icon :icon="['fas', 'heart']" class="text-sm" />
                    Favoritos
                  </a>
                  <button @click="logout" class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 transition text-red-600">
                    <font-awesome-icon :icon="['fas', 'sign-out-alt']" class="text-sm" />
                    Cerrar Sesión
                  </button>
                </div>
              </div>
            </div>
          </transition>
        </div>

        <!-- Carrito -->
        <div class="relative">
          <button @click="toggleCart" class="relative text-gray-700 text-2xl">
            <font-awesome-icon :icon="['fas', 'shopping-cart']" />
            <span v-if="cartItems.length > 0"
              class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 animate-pulse">
              {{ totalItems }}
            </span>
          </button>

          <!-- Dropdown del carrito -->
          <transition name="fade">
            <div v-if="cartOpen"
              class="absolute right-0 mt-2 w-80 max-h-96 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden flex flex-col">
              <div class="overflow-y-auto flex-1">
                <div v-for="(item, index) in cartItems" :key="index"
                  class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                  <div class="flex items-center gap-3">
                    <img :src="item.image" alt="Producto" class="w-12 h-12 object-cover rounded-lg">
                    <div>
                      <p class="font-semibold">{{ item.name }}</p>
                      <p class="text-sm text-gray-500">Precio unitario: ${{ item.price }}</p>
                      <div class="flex items-center mt-1 gap-2">
                        <button @click="decreaseQuantity(index)" class="bg-gray-200 px-2 rounded">-</button>
                        <span>{{ item.quantity }}</span>
                        <button @click="increaseQuantity(index)" class="bg-gray-200 px-2 rounded">+</button>
                      </div>
                    </div>
                  </div>
                  <p class="font-semibold">${{ (item.price * item.quantity).toFixed(0) }}</p>
                </div>
              </div>
              <div class="px-4 py-3 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
                <p class="font-bold">Total: ${{ total.toFixed(0) }}</p>
                <a class="bg-yellow-400 text-white px-4 py-2 rounded-lg font-semibold hover:brightness-105 transition"
                  href="/carrito">
                  Pagar
                </a>
              </div>
            </div>
          </transition>
        </div>
      </div>

    </div>
  </header>
</template>

<script>
import { ref, computed } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faSearch, faShoppingCart, faUser, faUserCircle, faBox, faHeart, faSignOutAlt } from '@fortawesome/free-solid-svg-icons'

library.add(faSearch, faShoppingCart, faUser, faUserCircle, faBox, faHeart, faSignOutAlt)

export default {
  name: "Header",
  components: { FontAwesomeIcon },
  setup() {
    const searchOpen = ref(false);
    const query = ref('');
    const cartOpen = ref(false);
    const userOpen = ref(false);
    const isLoggedIn = ref(false); // Cambia a true para probar el estado logueado

    // Datos del usuario (solo visibles cuando está logueado)
    const user = ref({
      name: 'Juan Pérez',
      email: 'juan@example.com',
      avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=64&q=80'
    });

    const cartItems = ref([
      { name: 'Almendras Premium', price: 5000, quantity: 2, image: 'https://images.unsplash.com/photo-1611078481039-0e118f2e503f?auto=format&fit=crop&w=64&q=80' },
      { name: 'Nueces Naturales', price: 4000, quantity: 1, image: 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?auto=format&fit=crop&w=64&q=80' },
      { name: 'Mix Frutos Secos', price: 7000, quantity: 3, image: 'https://images.unsplash.com/photo-1612392061780-fc2b3c0c5a36?auto=format&fit=crop&w=64&q=80' },
    ]);

    const toggleSearch = () => searchOpen.value = !searchOpen.value;
    const toggleCart = () => cartOpen.value = !cartOpen.value;
    const toggleUser = () => userOpen.value = !userOpen.value;

    const submitSearch = () => {
      if (query.value.trim() === '') return;
      console.log("Buscando:", query.value);
      query.value = '';
      searchOpen.value = false;
    };

    const login = () => {
      console.log("Redirigir a login");
      // Aquí podrías redirigir a tu página de login
      window.location.href = '/login';
      userOpen.value = false;
      
      // // Para demostración, simular login después de 1 segundo
      // setTimeout(() => {
      //   isLoggedIn.value = true;
      // }, 1000);
    };

    const register = () => {
      console.log("Redirigir a registro");
      // Aquí podrías redirigir a tu página de registro
      window.location.href = '/register';
      userOpen.value = false;
    };

    const logout = () => {
      isLoggedIn.value = false;
      userOpen.value = false;
      console.log("Usuario cerró sesión");
    };

    const increaseQuantity = (index) => {
      cartItems.value[index].quantity++;
    };

    const decreaseQuantity = (index) => {
      if (cartItems.value[index].quantity > 1) {
        cartItems.value[index].quantity--;
      }
    };

    const total = computed(() => cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0));
    const totalItems = computed(() => cartItems.value.reduce((sum, item) => sum + item.quantity, 0));

    return { 
      searchOpen, 
      query, 
      toggleSearch, 
      submitSearch, 
      cartOpen, 
      toggleCart, 
      userOpen,
      toggleUser,
      isLoggedIn,
      user,
      login,
      register,
      logout,
      cartItems, 
      total, 
      totalItems, 
      increaseQuantity, 
      decreaseQuantity 
    };
  }
}
</script>

<style scoped>
/* Animación fade + scale para el input */
.fade-scale-enter-active {
  transition: all 0.3s ease-in-out;
}

.fade-scale-leave-active {
  transition: all 0.2s ease-in-out;
}

.fade-scale-enter-from {
  opacity: 0;
  transform: scale(0.8) translateY(-10px);
}

.fade-scale-enter-to {
  opacity: 1;
  transform: scale(1) translateY(0);
}

.fade-scale-leave-from {
  opacity: 1;
  transform: scale(1) translateY(0);
}

.fade-scale-leave-to {
  opacity: 0;
  transform: scale(0.8) translateY(-10px);
}

/* Carrito y usuario fade */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>