<template>
  <div class="flex flex-col min-h-screen bg-gradient-to-br from-yellow-100 to-yellow-200">

    <!-- Header -->
    <Header />

    <!-- Contenido dinámico -->
    <main class="flex-grow">
      <router-view />
    </main>

    <!-- Footer -->
    <Footer />

    <!-- Bottom Navigation -->
    <BottomNav v-model:active="activeNav" />
  </div>
</template>

<script>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import BottomNav from './components/BottomNav.vue';

export default {
  name: "App",
  components: { Header, Footer, BottomNav },
  data() {
    return { activeNav: 'home' };
  }
};
</script>
