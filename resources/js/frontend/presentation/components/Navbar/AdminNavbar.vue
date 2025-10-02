<template>
  <nav class="bg-gradient-to-br from-nut-brown to-dark-chocolate shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo y título -->
        <div class="flex items-center space-x-4">
          <button
            @click="toggleSidebar"
            class="lg:hidden text-white hover:bg-nut-brown-dark p-2 rounded-lg transition-all duration-300"
            aria-label="Toggle menu"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                v-if="!isSidebarOpen"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                v-else
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>

          <div class="flex items-center space-x-3">
            <div class="bg-golden-yellow rounded-full p-2 shadow-golden-yellow/30">
              <svg class="w-6 h-6 text-dark-chocolate" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
              </svg>
            </div>
            <div>
              <h1 class="text-white font-bold text-xl">Panel Admin</h1>
              <p class="text-beige text-xs hidden sm:block">Gestión de productos</p>
            </div>
          </div>
        </div>

        <!-- Búsqueda (desktop) -->
        <div class="hidden md:flex flex-1 max-w-md mx-8">
          <div class="relative w-full">
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Buscar productos, categorías..."
              class="w-full bg-dark-chocolate text-white placeholder-beige px-4 py-2 pl-10 rounded-lg focus:outline-none focus:ring-2 focus:ring-golden-yellow transition-all duration-300"
              @input="handleSearch"
            />
            <svg
              class="w-5 h-5 text-beige absolute left-3 top-1/2 -translate-y-1/2"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
        </div>

        <!-- Acciones del usuario -->
        <div class="flex items-center space-x-3">
          <!-- Notificaciones -->
          <button
            @click="toggleNotifications"
            class="relative text-white hover:bg-nut-brown-dark p-2 rounded-lg transition-all duration-300"
            aria-label="Notificaciones"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span
              v-if="notificationCount > 0"
              class="absolute -top-1 -right-1 bg-burgundy-red text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center animate-pulse"
            >
              {{ notificationCount }}
            </span>
          </button>

          <!-- Dropdown de notificaciones -->
          <transition name="fade">
            <div
              v-if="showNotifications"
              class="absolute right-4 top-16 w-80 bg-white rounded-lg shadow-xl border border-gray-light overflow-hidden z-50"
            >
              <div class="bg-olive-green text-white px-4 py-3 font-semibold">
                Notificaciones
              </div>
              <div class="max-h-96 overflow-y-auto">
                <div
                  v-for="notification in notifications"
                  :key="notification.id"
                  class="px-4 py-3 hover:bg-beige border-b border-gray-light transition-colors cursor-pointer"
                  @click="markAsRead(notification.id)"
                >
                  <div class="flex items-start space-x-3">
                    <div
                      class="w-2 h-2 rounded-full mt-2 flex-shrink-0"
                      :class="notification.read ? 'bg-gray-light' : 'bg-burgundy-red'"
                    />
                    <div class="flex-1">
                      <p class="text-gray-dark font-medium text-sm">{{ notification.title }}</p>
                      <p class="text-gray-dark text-xs mt-1">{{ notification.message }}</p>
                      <p class="text-gray-400 text-xs mt-1">{{ notification.time }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-beige px-4 py-2 text-center">
                <button class="text-olive-green text-sm font-semibold hover:underline">
                  Ver todas
                </button>
              </div>
            </div>
          </transition>

          <!-- Perfil de usuario -->
          <div class="relative">
            <button
              @click="toggleUserMenu"
              class="flex items-center space-x-2 text-white hover:bg-nut-brown-dark px-3 py-2 rounded-lg transition-all duration-300"
            >
              <div class="w-8 h-8 bg-golden-yellow rounded-full flex items-center justify-center text-dark-chocolate font-bold">
                {{ userInitials }}
              </div>
              <span class="hidden lg:block font-medium">{{ userName }}</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Dropdown de usuario -->
            <transition name="fade">
              <div
                v-if="showUserMenu"
                class="absolute right-0 top-12 w-56 bg-white rounded-lg shadow-xl border border-gray-light overflow-hidden z-50"
              >
                <div class="px-4 py-3 bg-beige border-b border-gray-light">
                  <p class="text-gray-dark font-semibold">{{ userName }}</p>
                  <p class="text-gray-dark text-sm">{{ userEmail }}</p>
                </div>
                <div class="py-2">
                  <a
                    href="#"
                    class="flex items-center space-x-3 px-4 py-2 text-gray-dark hover:bg-beige transition-colors"
                    @click.prevent="goToProfile"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Mi perfil</span>
                  </a>
                  <a
                    href="#"
                    class="flex items-center space-x-3 px-4 py-2 text-gray-dark hover:bg-beige transition-colors"
                    @click.prevent="goToSettings"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Configuración</span>
                  </a>
                  <hr class="my-2 border-gray-light">
                  <a
                    href="#"
                    class="flex items-center space-x-3 px-4 py-2 text-burgundy-red hover:bg-beige transition-colors"
                    @click.prevent="logout"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Cerrar sesión</span>
                  </a>
                </div>
              </div>
            </transition>
          </div>
        </div>
      </div>

      <!-- Búsqueda móvil -->
      <div class="md:hidden pb-3">
        <div class="relative">
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Buscar..."
            class="w-full bg-dark-chocolate text-white placeholder-beige px-4 py-2 pl-10 rounded-lg focus:outline-none focus:ring-2 focus:ring-golden-yellow transition-all duration-300"
            @input="handleSearch"
          />
          <svg
            class="w-5 h-5 text-beige absolute left-3 top-1/2 -translate-y-1/2"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  userName: {
    type: String,
    default: 'Administrador'
  },
  userEmail: {
    type: String,
    default: 'admin@example.com'
  }
});

const emit = defineEmits([
  'toggle-sidebar',
  'search',
  'logout',
  'go-to-profile',
  'go-to-settings'
]);

// Estado
const isSidebarOpen = ref(false);
const showNotifications = ref(false);
const showUserMenu = ref(false);
const searchQuery = ref('');

// Notificaciones de ejemplo
const notifications = ref([
  {
    id: 1,
    title: 'Nuevo pedido',
    message: 'Tienes 3 nuevos pedidos pendientes',
    time: 'Hace 5 minutos',
    read: false
  },
  {
    id: 2,
    title: 'Stock bajo',
    message: 'Almendras naturales están bajo stock',
    time: 'Hace 1 hora',
    read: false
  },
  {
    id: 3,
    title: 'Producto actualizado',
    message: 'Nueces de California actualizado correctamente',
    time: 'Hace 2 horas',
    read: true
  }
]);

const notificationCount = computed(() => {
  return notifications.value.filter(n => !n.read).length;
});

const userInitials = computed(() => {
  return props.userName
    .split(' ')
    .map(n => n[0])
    .join('')
    .toUpperCase()
    .slice(0, 2);
});

// Métodos
const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
  emit('toggle-sidebar', isSidebarOpen.value);
};

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value;
  showUserMenu.value = false;
};

const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value;
  showNotifications.value = false;
};

const handleSearch = () => {
  emit('search', searchQuery.value);
};

const markAsRead = (id) => {
  const notification = notifications.value.find(n => n.id === id);
  if (notification) {
    notification.read = true;
  }
};

const logout = () => {
  emit('logout');
};

const goToProfile = () => {
  showUserMenu.value = false;
  emit('go-to-profile');
};

const goToSettings = () => {
  showUserMenu.value = false;
  emit('go-to-settings');
};

// Cerrar dropdowns al hacer click fuera
if (typeof document !== 'undefined') {
  document.addEventListener('click', (e) => {
    const target = e.target;
    if (!target.closest('.relative')) {
      showNotifications.value = false;
      showUserMenu.value = false;
    }
  });
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s ease;
}

.fade-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}

.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

/* Smooth scrollbar for notifications */
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: var(--color-gray-light);
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background: var(--color-olive-green);
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background: var(--color-olive-green-dark);
}
</style>