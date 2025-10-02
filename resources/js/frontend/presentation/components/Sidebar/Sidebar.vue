<template>
  <aside
    :class="[
      'fixed lg:static inset-y-0 left-0 z-40 w-64 bg-gradient-to-br from-dark-chocolate to-nut-brown-dark shadow-xl transition-transform duration-300 ease-in-out',
      isOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
    ]"
  >
    <!-- Overlay para móvil -->
    <div
      v-if="isOpen"
      @click="closeSidebar"
      class="fixed inset-0 bg-dark-chocolate bg-opacity-50 lg:hidden z-30"
    ></div>

    <!-- Contenido del Sidebar -->
    <div class="relative h-full flex flex-col bg-gradient-to-br from-dark-chocolate to-nut-brown-dark">
      <!-- Header del Sidebar -->
      <div class="flex items-center justify-between px-6 py-5 border-b border-nut-brown">
        <div class="flex items-center space-x-3">
          <div class="bg-golden-yellow rounded-lg p-2 shadow-golden-yellow/30">
            <svg class="w-6 h-6 text-dark-chocolate" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
          </div>
          <div>
            <h2 class="text-white font-bold text-lg">Mi Tienda</h2>
            <p class="text-beige text-xs">Frutos & Más</p>
          </div>
        </div>
        <button
          @click="closeSidebar"
          class="lg:hidden text-white hover:bg-nut-brown p-1 rounded transition-colors"
          aria-label="Cerrar menú"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Navegación -->
      <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">
        <!-- Dashboard -->
        <router-link
          v-for="item in menuItems"
          :key="item.name"
          :to="item.path"
          :class="[
            'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-300 group',
            isActive(item.path)
              ? 'bg-olive-green text-white shadow-lg shadow-olive-green/30'
              : 'text-beige hover:bg-nut-brown hover:text-white'
          ]"
          @click="handleNavigation(item)"
        >
          <component
            :is="item.icon"
            :class="[
              'w-5 h-5 transition-transform duration-300',
              isActive(item.path) ? 'scale-110' : 'group-hover:scale-110'
            ]"
          />
          <span class="font-medium">{{ item.name }}</span>
          <span
            v-if="item.badge"
            class="ml-auto bg-burgundy-red text-white text-xs font-bold px-2 py-1 rounded-full animate-pulse"
          >
            {{ item.badge }}
          </span>
        </router-link>

        <!-- Secciones con subcategorías -->
        <div v-for="section in sections" :key="section.title" class="pt-4">
          <h3 class="text-beige text-xs font-semibold uppercase tracking-wider px-4 mb-2">
            {{ section.title }}
          </h3>
          <router-link
            v-for="item in section.items"
            :key="item.name"
            :to="item.path"
            :class="[
              'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-300 group',
              isActive(item.path)
                ? 'bg-olive-green text-white shadow-lg shadow-olive-green/30'
                : 'text-beige hover:bg-nut-brown hover:text-white'
            ]"
            @click="handleNavigation(item)"
          >
            <component
              :is="item.icon"
              :class="[
                'w-5 h-5 transition-transform duration-300',
                isActive(item.path) ? 'scale-110' : 'group-hover:scale-110'
              ]"
            />
            <span class="font-medium">{{ item.name }}</span>
            <span
              v-if="item.badge"
              class="ml-auto bg-orange-warm text-white text-xs font-bold px-2 py-1 rounded-full"
            >
              {{ item.badge }}
            </span>
          </router-link>
        </div>
      </nav>

      <!-- Footer del Sidebar -->
      <div class="border-t border-nut-brown px-4 py-4 space-y-2">
        <button
          @click="toggleTheme"
          class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-beige hover:bg-nut-brown hover:text-white transition-all duration-300 group"
        >
          <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
          <span class="font-medium">Tema Oscuro</span>
        </button>

        <button
          @click="showHelp"
          class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-beige hover:bg-nut-brown hover:text-white transition-all duration-300 group"
        >
          <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="font-medium">Ayuda</span>
        </button>

        <!-- Versión -->
        <div class="px-4 py-2 text-center">
          <p class="text-beige text-xs">Versión 1.0.0</p>
        </div>
      </div>
    </div>
  </aside>
</template>

<script setup>
import { ref, computed, h } from 'vue';
import { useRoute } from 'vue-router';

const props = defineProps({
  isOpen: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits(['close', 'navigate', 'toggle-theme', 'show-help']);

const route = useRoute();

// Iconos SVG como componentes
const DashboardIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' })
]);

const ProductsIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4' })
]);

const OrdersIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z' })
]);

const CustomersIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z' })
]);

const AnalyticsIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z' })
]);

const CategoriesIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z' })
]);

const InventoryIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01' })
]);

const SettingsIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z' })
]);

const ReportsIcon = () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' })
]);

// Menú principal
const menuItems = ref([
  { name: 'Dashboard', path: '/admin', icon: DashboardIcon },
  { name: 'Productos', path: '/admin/productos', icon: ProductsIcon },
  { name: 'Pedidos', path: '/admin/pedidos', icon: OrdersIcon, badge: '5' },
  { name: 'Clientes', path: '/admin/clientes', icon: CustomersIcon },
  { name: 'Analíticas', path: '/admin/analiticas', icon: AnalyticsIcon }
]);

// Secciones con subcategorías
const sections = ref([
  {
    title: 'Gestión',
    items: [
      { name: 'Categorías', path: '/admin/categorias', icon: CategoriesIcon },
      { name: 'Inventario', path: '/admin/inventario', icon: InventoryIcon, badge: '3' },
      { name: 'Reportes', path: '/admin/reportes', icon: ReportsIcon }
    ]
  },
  {
    title: 'Configuración',
    items: [
      { name: 'Ajustes', path: '/admin/ajustes', icon: SettingsIcon }
    ]
  }
]);

// Métodos
const isActive = (path) => {
  if (path === '/admin') {
    return route.path === '/admin';
  }
  return route.path.startsWith(path);
};

const closeSidebar = () => {
  emit('close');
};

const handleNavigation = (item) => {
  emit('navigate', item);
  if (window.innerWidth < 1024) {
    closeSidebar();
  }
};

const toggleTheme = () => {
  emit('toggle-theme');
};

const showHelp = () => {
  emit('show-help');
};
</script>
