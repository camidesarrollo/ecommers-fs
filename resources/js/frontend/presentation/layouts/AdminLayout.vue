<!-- <template>
  <div class="flex h-screen overflow-hidden bg-beige">
    <Sidebar
      :is-open="sidebarOpen"
      @close="sidebarOpen = false"
      @navigate="handleNavigation"
      @toggle-theme="toggleTheme"
      @show-help="showHelp"
    />

    <div class="flex-1 flex flex-col overflow-hidden">
      <AdminNavbar
        :user-name="userName"
        :user-email="userEmail"
        @toggle-sidebar="sidebarOpen = !sidebarOpen"
        @search="handleSearch"
        @logout="handleLogout"
        @go-to-profile="goToProfile"
        @go-to-settings="goToSettings"
      />

      <main class="flex-1 overflow-y-auto bg-gray-light">
        <div class="px-4 md:px-8 lg:px-10 py-8 mx-auto w-full">
          <router-view />
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import AdminNavbar from '../components/Navbar/AdminNavbar.vue';
import Sidebar from '../components/Sidebar/Sidebar.vue';

export default {
  name: 'AdminLayout',
  components: {
    AdminNavbar,
    Sidebar,
  },
  data() {
    return {
      sidebarOpen: false,
      userName: 'Juan Pérez',
      userEmail: 'admin@frutosymas.com',
    };
  },
  methods: {
    handleNavigation(item) {
      console.log('Navegando a:', item.name);
    },
    toggleTheme() {
      document.documentElement.classList.toggle('dark');
    },
    showHelp() {
      console.log('Mostrar ayuda');
    },
    handleSearch(query) {
      console.log('Buscar:', query);
    },
    handleLogout() {
      this.$router.push('/login');
    },
    goToProfile() {
      this.$router.push('/admin/perfil');
    },
    goToSettings() {
      this.$router.push('/admin/ajustes');
    },
  },
};
</script> -->

<template>
  <div class="flex h-screen overflow-hidden bg-beige">
    <Sidebar
      :is-open="sidebarOpen"
      @close="sidebarOpen = false"
      @navigate="handleNavigation"
      @toggle-theme="toggleTheme"
      @show-help="showHelp"
    />

    <div class="flex-1 flex flex-col overflow-hidden">
      <AdminNavbar
        :user-name="userName"
        :user-email="userEmail"
        @toggle-sidebar="sidebarOpen = !sidebarOpen"
        @search="handleSearch"
        @logout="handleLogout"
        @go-to-profile="goToProfile"
        @go-to-settings="goToSettings"
      />

      <main class="flex-1 overflow-y-auto bg-gray-light">
        <div class="px-4 md:px-8 lg:px-10 py-8 mx-auto w-full">
          <router-view />
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import AdminNavbar from '../components/Navbar/AdminNavbar.vue';
import Sidebar from '../components/Sidebar/Sidebar.vue';

export default {
  name: 'AdminLayout',
  components: {
    AdminNavbar,
    Sidebar,
  },
  data() {
    return {
      sidebarOpen: false,
      userName: 'Juan Pérez',
      userEmail: 'admin@frutosymas.com',
    };
  },
  methods: {
    handleNavigation(item) {
      console.log('Navegando a:', item.name);
    },
    toggleTheme() {
      document.documentElement.classList.toggle('dark');
    },
    showHelp() {
      console.log('Mostrar ayuda');
    },
    handleSearch(query) {
      console.log('Buscar:', query);
    },
    handleLogout() {
      this.$router.push('/login');
    },
    goToProfile() {
      this.$router.push('/admin/perfil');
    },
    goToSettings() {
      this.$router.push('/admin/ajustes');
    },
  },
};
</script>