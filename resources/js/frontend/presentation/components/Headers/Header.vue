<template>
  <header class="sticky top-0 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm z-50">
    <div class="container mx-auto px-3 sm:px-6 lg:px-8 flex justify-between items-center py-3 sm:py-4">

      <!-- Logo -->
      <div class="flex items-center gap-2 sm:gap-3">
        <div class="rounded-full p-1.5 sm:p-2 bg-gradient-to-br from-yellow-700 to-yellow-500 text-white">
          <a class="/">
            <img src="/public/img/fbe92c76-59d0-4525-a1fe-8e06a4c98dbd2.PNG" alt="" class="w-8 h-8 sm:w-10 sm:h-10" />
          </a>

        </div>
        <span class="font-bold text-base sm:text-xl text-gray-800 hidden xs:inline">Secos y saludables JPJ</span>
        <span class="font-bold text-base text-gray-800 xs:hidden">JPJ</span>
      </div>

      <!-- Botones de acción -->
      <div class="flex items-center gap-2 sm:gap-3 relative">
        <!-- Buscar -->
        <div class="relative">
          <button @click="toggleSearch"
            class="text-gray-700 text-xl sm:text-2xl relative z-20 p-2 hover:bg-gray-100 rounded-full transition">
            <font-awesome-icon :icon="['fas', 'search']" />
          </button>

          <!-- Input animado - Desktop -->
          <transition name="fade-scale">
            <input v-if="searchOpen" v-model="query" type="text" placeholder="Buscar productos..." class="hidden md:block absolute right-0 top-0 mt-12 w-64 md:w-80 px-4 py-2 rounded-lg 
                     bg-white/95 text-gray-800 border-2 border-transparent shadow-lg
                     focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 
                     focus:ring-opacity-50 transition-all duration-300 ease-in-out z-10" @keyup.enter="submitSearch"
              autofocus />
          </transition>
        </div>

        <!-- Usuario/Login -->
        <div class="relative">
          <button @click="toggleUser"
            class="text-gray-700 text-xl sm:text-2xl relative p-2 hover:bg-gray-100 rounded-full transition">
            <font-awesome-icon v-if="!isLoggedIn" :icon="['fas', 'user']" />
            <img v-else :src="user.avatar" :alt="user.name"
              class="w-7 h-7 sm:w-8 sm:h-8 rounded-full object-cover border-2 border-yellow-400">
          </button>

          <!-- Dropdown del usuario - Desktop -->
          <transition name="fade">
            <div v-if="userOpen"
              class="hidden md:block absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden">

              <!-- Usuario no logueado -->
              <div v-if="!isLoggedIn" class="p-4">
                <div class="text-center mb-4">
                  <font-awesome-icon :icon="['fas', 'user-circle']" class="text-4xl text-gray-400 mb-2" />
                  <p class="text-gray-600 text-sm">¡Inicia sesión para acceder a tu cuenta!</p>
                </div>
                <div class="space-y-2">
                  <button @click="login"
                    class="w-full bg-yellow-400 text-white px-4 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
                    Iniciar Sesión
                  </button>
                  <button @click="register"
                    class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
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
                  <a href="/perfil"
                    class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 transition text-gray-700">
                    <font-awesome-icon :icon="['fas', 'user']" class="text-sm" />
                    Mi Perfil
                  </a>
                  <a href="/pedidos"
                    class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 transition text-gray-700">
                    <font-awesome-icon :icon="['fas', 'box']" class="text-sm" />
                    Mis Pedidos
                  </a>
                  <a href="/favoritos"
                    class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 transition text-gray-700">
                    <font-awesome-icon :icon="['fas', 'heart']" class="text-sm" />
                    Favoritos
                  </a>
                  <button @click="logout"
                    class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 transition text-red-600">
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
          <button @click="toggleCart"
            class="relative text-gray-700 text-xl sm:text-2xl p-2 hover:bg-gray-100 rounded-full transition">
            <font-awesome-icon :icon="['fas', 'shopping-cart']" />
            <span v-if="cartItems.length > 0"
              class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1.5 min-w-[20px] h-5 flex items-center justify-center font-semibold">
              {{ totalItems }}
            </span>
          </button>

          <!-- Dropdown del carrito - Desktop -->
          <transition name="fade">
            <div v-if="cartOpen"
              class="hidden md:flex absolute right-0 mt-2 w-80 max-h-96 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden flex-col">
              <div class="overflow-y-auto flex-1">
                <div v-if="cartItems.length === 0" class="p-8 text-center text-gray-500">
                  <font-awesome-icon :icon="['fas', 'shopping-cart']" class="text-4xl mb-3 opacity-50" />
                  <p>Tu carrito está vacío</p>
                </div>
                <div v-for="(item, index) in cartItems" :key="index"
                  class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                  <div class="flex items-center gap-3 flex-1">
                    <img :src="item.image" alt="Producto" class="w-12 h-12 object-cover rounded-lg">
                    <div class="flex-1 min-w-0">
                      <p class="font-semibold text-sm truncate">{{ item.name }}</p>
                      <p class="text-xs text-gray-500">${{ item.price.toLocaleString() }}</p>
                      <div class="flex items-center mt-1 gap-2">
                        <button @click="decreaseQuantity(index)"
                          class="bg-gray-200 w-6 h-6 rounded flex items-center justify-center hover:bg-gray-300 transition">-</button>
                        <span class="text-sm font-medium">{{ item.quantity }}</span>
                        <button @click="increaseQuantity(index)"
                          class="bg-gray-200 w-6 h-6 rounded flex items-center justify-center hover:bg-gray-300 transition">+</button>
                      </div>
                    </div>
                  </div>
                  <p class="font-semibold text-sm ml-2">${{ (item.price * item.quantity).toLocaleString() }}</p>
                </div>
              </div>
              <div v-if="cartItems.length > 0"
                class="px-4 py-3 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
                <p class="font-bold">Total: ${{ total.toLocaleString() }}</p>
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

    <!-- Barra de búsqueda móvil -->
    <transition name="slide-down">
      <div v-if="searchOpen" class="md:hidden px-3 pb-3">
        <input v-model="query" type="text" placeholder="Buscar productos..." class="w-full px-4 py-2 rounded-lg bg-white text-gray-800 border-2 border-gray-200
                 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 
                 focus:ring-opacity-50 transition-all" @keyup.enter="submitSearch" autofocus />
      </div>
    </transition>
  </header>

  <!-- Overlay oscuro para móvil -->
  <transition name="fade">
    <div v-if="(cartOpen || userOpen) && isMobile" @click="closeAllModals"
      class="md:hidden fixed inset-0 bg-black/50 z-40"></div>
  </transition>

  <!-- Panel de usuario móvil - Desde abajo -->
  <transition name="slide-up">
    <div v-if="userOpen && isMobile"
      class="md:hidden fixed bottom-0 left-0 right-0 bg-white rounded-t-2xl shadow-2xl z-50 max-h-[85vh] overflow-y-auto">

      <!-- Handle para arrastrar -->
      <div class="flex justify-center pt-3 pb-2">
        <div class="w-12 h-1 bg-gray-300 rounded-full"></div>
      </div>

      <!-- Usuario no logueado -->
      <div v-if="!isLoggedIn" class="p-6">
        <div class="text-center mb-6">
          <font-awesome-icon :icon="['fas', 'user-circle']" class="text-5xl text-gray-400 mb-3" />
          <h3 class="text-lg font-bold text-gray-800 mb-2">¡Bienvenido!</h3>
          <p class="text-gray-600 text-sm">Inicia sesión para acceder a tu cuenta</p>
        </div>
        <div class="space-y-3">
          <button @click="login"
            class="w-full bg-yellow-400 text-white px-4 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
            Iniciar Sesión
          </button>
          <button @click="register"
            class="w-full bg-gray-200 text-gray-700 px-4 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
            Registrarse
          </button>
        </div>
      </div>

      <!-- Usuario logueado -->
      <div v-else class="p-6">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
          <img :src="user.avatar" :alt="user.name" class="w-16 h-16 rounded-full object-cover">
          <div>
            <p class="font-bold text-gray-800 text-lg">{{ user.name }}</p>
            <p class="text-sm text-gray-500">{{ user.email }}</p>
          </div>
        </div>
        <div class="space-y-2">
          <a href="/perfil"
            class="flex items-center gap-3 w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700 text-base">
            <font-awesome-icon :icon="['fas', 'user']" class="text-lg w-5" />
            Mi Perfil
          </a>
          <a href="/pedidos"
            class="flex items-center gap-3 w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700 text-base">
            <font-awesome-icon :icon="['fas', 'box']" class="text-lg w-5" />
            Mis Pedidos
          </a>
          <a href="/favoritos"
            class="flex items-center gap-3 w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700 text-base">
            <font-awesome-icon :icon="['fas', 'heart']" class="text-lg w-5" />
            Favoritos
          </a>
          <button @click="logout"
            class="flex items-center gap-3 w-full text-left px-4 py-3 rounded-lg hover:bg-red-50 transition text-red-600 text-base font-medium">
            <font-awesome-icon :icon="['fas', 'sign-out-alt']" class="text-lg w-5" />
            Cerrar Sesión
          </button>
        </div>
      </div>
    </div>
  </transition>

  <!-- Panel de carrito móvil - Desde abajo -->
  <transition name="slide-up">
    <div v-if="cartOpen && isMobile"
      class="md:hidden fixed bottom-0 left-0 right-0 bg-white rounded-t-2xl shadow-2xl z-50 max-h-[85vh] flex flex-col">

      <!-- Header del carrito -->
      <div class="flex-shrink-0 border-b border-gray-200 px-4 pt-3 pb-4">
        <div class="flex justify-center mb-2">
          <div class="w-12 h-1 bg-gray-300 rounded-full"></div>
        </div>
        <div class="flex justify-between items-center">
          <h3 class="text-lg font-bold text-gray-800">Mi Carrito</h3>
          <button @click="closeAllModals" class="text-gray-500 hover:text-gray-700 p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Contenido del carrito -->
      <div class="flex-1 overflow-y-auto px-4">
        <div v-if="cartItems.length === 0" class="py-16 text-center text-gray-500">
          <font-awesome-icon :icon="['fas', 'shopping-cart']" class="text-5xl mb-4 opacity-50" />
          <p class="text-lg">Tu carrito está vacío</p>
          <p class="text-sm mt-2">¡Agrega productos para comenzar!</p>
        </div>

        <div v-for="(item, index) in cartItems" :key="index"
          class="flex items-start gap-3 py-4 border-b border-gray-100">
          <img :src="item.image" alt="Producto" class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
          <div class="flex-1 min-w-0">
            <p class="font-semibold text-gray-800 mb-1">{{ item.name }}</p>
            <p class="text-sm text-gray-500 mb-2">${{ item.price.toLocaleString() }} c/u</p>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <button @click="decreaseQuantity(index)"
                  class="bg-gray-200 w-8 h-8 rounded-lg flex items-center justify-center hover:bg-gray-300 transition font-semibold">-</button>
                <span class="font-medium w-8 text-center">{{ item.quantity }}</span>
                <button @click="increaseQuantity(index)"
                  class="bg-gray-200 w-8 h-8 rounded-lg flex items-center justify-center hover:bg-gray-300 transition font-semibold">+</button>
              </div>
              <p class="font-bold text-gray-800">${{ (item.price * item.quantity).toLocaleString() }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer del carrito con total y botón de pago -->
      <div v-if="cartItems.length > 0" class="flex-shrink-0 border-t border-gray-200 bg-gray-50 p-4">
        <div class="flex justify-between items-center mb-3">
          <span class="text-gray-600">Subtotal</span>
          <span class="font-semibold text-gray-800">${{ total.toLocaleString() }}</span>
        </div>
        <a href="/carrito"
          class="block w-full bg-yellow-400 text-white text-center px-4 py-3 rounded-lg font-bold hover:bg-yellow-500 transition">
          Proceder al Pago
        </a>
      </div>
    </div>
  </transition>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from 'vue';
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
    const isLoggedIn = ref(false);
    const isMobile = ref(false);

    // Detectar si es móvil
    const checkMobile = () => {
      isMobile.value = window.innerWidth < 768;
    };

    onMounted(() => {
      checkMobile();
      window.addEventListener('resize', checkMobile);
    });

    onUnmounted(() => {
      window.removeEventListener('resize', checkMobile);
    });

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

    const toggleSearch = () => {
      searchOpen.value = !searchOpen.value;
      if (searchOpen.value) {
        cartOpen.value = false;
        userOpen.value = false;
      }
    };

    const toggleCart = () => {
      cartOpen.value = !cartOpen.value;
      if (cartOpen.value) {
        searchOpen.value = false;
        userOpen.value = false;
      }
    };

    const toggleUser = () => {
      userOpen.value = !userOpen.value;
      if (userOpen.value) {
        searchOpen.value = false;
        cartOpen.value = false;
      }
    };

    const closeAllModals = () => {
      cartOpen.value = false;
      userOpen.value = false;
      searchOpen.value = false;
    };

    const submitSearch = () => {
      if (query.value.trim() === '') return;
      console.log("Buscando:", query.value);
      query.value = '';
      searchOpen.value = false;
    };

    const login = () => {
      console.log("Redirigir a login");
      window.location.href = '/login';
      userOpen.value = false;
    };

    const register = () => {
      console.log("Redirigir a registro");
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
      closeAllModals,
      isLoggedIn,
      isMobile,
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
.fade-scale-enter-active,
.fade-scale-leave-active {
  transition: all 0.3s ease-in-out;
}

.fade-scale-enter-from,
.fade-scale-leave-to {
  opacity: 0;
  transform: scale(0.8) translateY(-10px);
}

/* Animación slide desde abajo para modales móviles */
.slide-up-enter-active,
.slide-up-leave-active {
  transition: transform 0.3s ease-out, opacity 0.3s ease-out;
}

.slide-up-enter-from,
.slide-up-leave-to {
  transform: translateY(100%);
  opacity: 0;
}

/* Animación slide down para búsqueda móvil */
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease-out;
}

.slide-down-enter-from,
.slide-down-leave-to {
  transform: translateY(-100%);
  opacity: 0;
}

/* Fade general */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Evitar scroll del body cuando los modales están abiertos */
body.modal-open {
  overflow: hidden;
}
</style>