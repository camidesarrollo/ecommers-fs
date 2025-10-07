<template>
  <nav class="bg-white border-b border-gray-200 sticky top-[73px] sm:top-[81px] z-30 shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Navegación Desktop -->
      <div class="hidden lg:flex items-center justify-center gap-8 py-4">
        
        <!-- Inicio -->
        <a 
          href="/" 
          class="text-gray-700 hover:text-yellow-500 font-medium transition-colors duration-200 flex items-center gap-2"
        >
          <font-awesome-icon :icon="['fas', 'home']" class="text-sm" />
          Inicio
        </a>

        <!-- Productos con dropdown -->
        <div class="relative" @mouseenter="openProducts" @mouseleave="closeProducts">
          <button 
            class="text-gray-700 hover:text-yellow-500 font-medium transition-colors duration-200 flex items-center gap-2"
            :class="{ 'text-yellow-500': productsOpen }"
          >
            <font-awesome-icon :icon="['fas', 'box-open']" class="text-sm" />
            Productos
            <font-awesome-icon :icon="['fas', 'chevron-down']" class="text-xs transition-transform duration-200" :class="{ 'rotate-180': productsOpen }" />
          </button>

          <!-- Dropdown de categorías -->
          <transition name="fade-scale-dropdown">
            <div 
              v-if="productsOpen"
              class="absolute top-full left-0 mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50"
            >
              <a 
                href="/productos"
                class="block px-4 py-3 text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-colors font-medium border-b border-gray-100"
              >
                <font-awesome-icon :icon="['fas', 'th-large']" class="mr-2 text-sm" />
                Ver Todos los Productos
              </a>
              
              <div class="py-2">
                <p class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Categorías</p>
                <a 
                  v-for="categoria in categorias" 
                  :key="categoria.id"
                  :href="`/productos?categoria=${categoria.id}`"
                  class="block px-4 py-2.5 text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-colors"
                >
                  <span class="mr-2">{{ categoria.icon }}</span>
                  {{ categoria.name }}
                </a>
              </div>
            </div>
          </transition>
        </div>

        <!-- Nosotros -->
        <a 
          href="/about" 
          class="text-gray-700 hover:text-yellow-500 font-medium transition-colors duration-200 flex items-center gap-2"
        >
          <font-awesome-icon :icon="['fas', 'users']" class="text-sm" />
          Nosotros
        </a>

        <!-- Contacto -->
        <a 
          href="/contacto" 
          class="text-gray-700 hover:text-yellow-500 font-medium transition-colors duration-200 flex items-center gap-2"
        >
          <font-awesome-icon :icon="['fas', 'envelope']" class="text-sm" />
          Contacto
        </a>

        <!-- Términos y Condiciones -->
        <a 
          href="/terminos" 
          class="text-gray-700 hover:text-yellow-500 font-medium transition-colors duration-200 flex items-center gap-2"
        >
          <font-awesome-icon :icon="['fas', 'file-alt']" class="text-sm" />
          Términos y Condiciones
        </a>
      </div>

      <!-- Navegación Mobile -->
      <div class="lg:hidden flex items-center justify-between py-3">
        <button 
          @click="toggleMobileMenu"
          class="text-gray-700 p-2 hover:bg-gray-100 rounded-lg transition"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        <span class="text-sm font-medium text-gray-700">Menú de Navegación</span>
        <div class="w-10"></div> <!-- Spacer para centrar -->
      </div>
    </div>

    <!-- Overlay oscuro para móvil (z-index menor que header pero mayor que contenido) -->
    <transition name="fade">
      <div 
        v-if="mobileMenuOpen" 
        @click="closeMobileMenu"
        class="lg:hidden fixed inset-0 bg-black/50 z-[45]"
        style="top: 0; left: 0; right: 0; bottom: 0;"
      ></div>
    </transition>

    <!-- Menú lateral móvil (z-index 48 para estar debajo del header z-50) -->
    <transition name="slide-right">
      <div 
        v-if="mobileMenuOpen"
        class="lg:hidden fixed top-0 left-0 bottom-0 w-80 max-w-[85vw] bg-white shadow-2xl z-[48] overflow-y-auto"
      >
        <!-- Header del menú -->
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-6 text-white">
          <div class="flex items-center justify-between mb-2">
            <h2 class="text-xl font-bold">Menú</h2>
            <button @click="closeMobileMenu" class="p-2 hover:bg-white/20 rounded-lg transition">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <p class="text-yellow-100 text-sm">Secos y saludables JPJ</p>
        </div>

        <!-- Opciones del menú -->
        <div class="py-2">
          <!-- Inicio -->
          <a 
            href="/" 
            class="flex items-center gap-3 px-6 py-4 text-gray-700 hover:bg-yellow-50 transition-colors border-b border-gray-100"
            @click="closeMobileMenu"
          >
            <font-awesome-icon :icon="['fas', 'home']" class="text-yellow-500 w-5" />
            <span class="font-medium">Inicio</span>
          </a>

          <!-- Productos con dropdown -->
          <div class="border-b border-gray-100">
            <button 
              @click="toggleMobileProducts"
              class="flex items-center justify-between w-full px-6 py-4 text-gray-700 hover:bg-yellow-50 transition-colors"
            >
              <div class="flex items-center gap-3">
                <font-awesome-icon :icon="['fas', 'box-open']" class="text-yellow-500 w-5" />
                <span class="font-medium">Productos</span>
              </div>
              <font-awesome-icon 
                :icon="['fas', 'chevron-down']" 
                class="text-sm transition-transform duration-200" 
                :class="{ 'rotate-180': mobileProductsOpen }" 
              />
            </button>

            <!-- Subcategorías -->
            <transition name="slide-down">
              <div v-if="mobileProductsOpen" class="bg-gray-50 py-2">
                <a 
                  href="/productos"
                  class="flex items-center gap-3 px-6 py-3 text-gray-700 hover:bg-yellow-50 transition-colors"
                  @click="closeMobileMenu"
                >
                  <font-awesome-icon :icon="['fas', 'th-large']" class="text-yellow-500 text-sm w-5 ml-8" />
                  <span class="text-sm font-medium">Ver Todos</span>
                </a>
                
                <div class="mt-2 pt-2 border-t border-gray-200 mx-6">
                  <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Categorías</p>
                </div>
                
                <a 
                  v-for="categoria in categorias" 
                  :key="categoria.id"
                  :href="`/productos?categoria=${categoria.id}`"
                  class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:bg-yellow-50 hover:text-gray-700 transition-colors"
                  @click="closeMobileMenu"
                >
                  <span class="text-lg ml-8">{{ categoria.icon }}</span>
                  <span class="text-sm">{{ categoria.name }}</span>
                </a>
              </div>
            </transition>
          </div>

          <!-- Nosotros -->
          <a 
            href="/about" 
            class="flex items-center gap-3 px-6 py-4 text-gray-700 hover:bg-yellow-50 transition-colors border-b border-gray-100"
            @click="closeMobileMenu"
          >
            <font-awesome-icon :icon="['fas', 'users']" class="text-yellow-500 w-5" />
            <span class="font-medium">Nosotros</span>
          </a>

          <!-- Contacto -->
          <a 
            href="/contacto" 
            class="flex items-center gap-3 px-6 py-4 text-gray-700 hover:bg-yellow-50 transition-colors border-b border-gray-100"
            @click="closeMobileMenu"
          >
            <font-awesome-icon :icon="['fas', 'envelope']" class="text-yellow-500 w-5" />
            <span class="font-medium">Contacto</span>
          </a>

          <!-- Términos y Condiciones -->
          <a 
            href="/terminos" 
            class="flex items-center gap-3 px-6 py-4 text-gray-700 hover:bg-yellow-50 transition-colors border-b border-gray-100"
            @click="closeMobileMenu"
          >
            <font-awesome-icon :icon="['fas', 'file-alt']" class="text-yellow-500 w-5" />
            <span class="font-medium">Términos y Condiciones</span>
          </a>
        </div>

        <!-- Footer del menú móvil -->
        <div class="mt-auto p-6 bg-gray-50 border-t border-gray-200">
          <p class="text-xs text-gray-500 text-center">© 2025 Secos y saludables JPJ</p>
        </div>
      </div>
    </transition>
  </nav>
</template>

<script setup>
import { ref } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { 
  faHome, 
  faBoxOpen, 
  faUsers, 
  faEnvelope, 
  faFileAlt, 
  faChevronDown,
  faThLarge
} from '@fortawesome/free-solid-svg-icons';

library.add(faHome, faBoxOpen, faUsers, faEnvelope, faFileAlt, faChevronDown, faThLarge);

// Estados
const productsOpen = ref(false);
const mobileMenuOpen = ref(false);
const mobileProductsOpen = ref(false);

// Categorías de ejemplo - Puedes reemplazar esto con datos dinámicos
const categorias = ref([
  { id: 1, name: 'Frutos Secos', icon: '🥜' },
  { id: 2, name: 'Semillas', icon: '🌰' },
  { id: 3, name: 'Frutas Deshidratadas', icon: '🍇' },
  { id: 4, name: 'Mix Saludables', icon: '🥗' },
  { id: 5, name: 'Snacks', icon: '🍿' },
  { id: 6, name: 'Superfoods', icon: '✨' },
]);

// Funciones para desktop
const openProducts = () => {
  productsOpen.value = true;
};

const closeProducts = () => {
  productsOpen.value = false;
};

// Funciones para mobile
const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value;
  if (!mobileMenuOpen.value) {
    mobileProductsOpen.value = false;
  }
};

const closeMobileMenu = () => {
  mobileMenuOpen.value = false;
  mobileProductsOpen.value = false;
};

const toggleMobileProducts = () => {
  mobileProductsOpen.value = !mobileProductsOpen.value;
};
</script>

<style scoped>
/* Animaciones para dropdown desktop */
.fade-scale-dropdown-enter-active,
.fade-scale-dropdown-leave-active {
  transition: all 0.2s ease-out;
}

.fade-scale-dropdown-enter-from,
.fade-scale-dropdown-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

/* Animación slide desde la izquierda para menú móvil */
.slide-right-enter-active,
.slide-right-leave-active {
  transition: transform 0.3s ease-out;
}

.slide-right-enter-from,
.slide-right-leave-to {
  transform: translateX(-100%);
}

/* Animación slide down para subcategorías móviles */
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease-out;
}

.slide-down-enter-from,
.slide-down-leave-to {
  max-height: 0;
  opacity: 0;
}

.slide-down-enter-to,
.slide-down-leave-from {
  max-height: 500px;
  opacity: 1;
}

/* Fade para overlay */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>