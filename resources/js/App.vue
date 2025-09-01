<template>
  <div class="flex flex-col min-h-screen bg-gradient-to-br from-yellow-100 to-yellow-200">
    
    <!-- Header -->
    <Header />

    <!-- Contenido principal -->
    <main class="flex-grow pb-24">
      <!-- Hero -->
      <section class="relative overflow-hidden py-20 text-white bg-gradient-to-tr from-indigo-500 to-purple-700">
        <!-- Fondos con emojis flotando -->
        <div class="absolute inset-0 opacity-10">
          <div class="absolute animate-float" style="top: 60px; left: 40px; font-size: 5rem;">🌰</div>
          <div class="absolute animate-float animate-float-delay-1" style="top: 150px; right: 30px; font-size: 4rem;">🥜</div>
          <div class="absolute animate-float animate-float-delay-2" style="bottom: 80px; left: 20px; font-size: 3rem;">🌰</div>
        </div>

        <!-- Contenido principal -->
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h1 class="text-5xl md:text-6xl font-extrabold mb-4 hero-text">Frutos Secos Premium</h1>
          <p class="text-xl md:text-2xl mb-8 hero-text opacity-90">Naturales, frescos y llenos de sabor</p>
          <button
            class="bg-gradient-to-r from-pink-500 to-yellow-400 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:brightness-110 transition">
            Explorar Productos
          </button>
        </div>
      </section>

      <!-- Categories -->
      <section class="py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
          <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Categorías</h2>
          <div class="grid grid-cols-2 gap-4">
            <CategoryPill name="Almendras" emoji="🥜" bgClass="bg-gradient-to-br from-yellow-400 to-yellow-500" />
            <CategoryPill name="Nueces" emoji="🌰" bgClass="bg-gradient-to-br from-yellow-300 to-yellow-400" />
            <CategoryPill name="Pistachos" emoji="🥨" bgClass="bg-gradient-to-br from-green-400 to-green-500" />
            <CategoryPill name="Mix Premium" emoji="🥜" bgClass="bg-gradient-to-br from-pink-400 to-pink-500" />
          </div>
        </div>
      </section>

      <!-- Products Offer -->
      <ProductosOferta />

      <!-- Special Offer -->
      <section class="py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
          <SpecialOffer title="¡Oferta Especial!" subtitle="Compra 3 productos y llévate el 4to GRATIS"
            buttonText="Aprovechar Oferta" />
        </div>
      </section>

      <!-- Featured Products -->
      <ProductosDestacados />

    </main>

    <!-- Footer (siempre antes del BottomNav) -->
    <Footer />

    <!-- Bottom Navigation (fijo abajo) -->
    <BottomNav v-model:active="activeNav" />
  </div>
</template>

<script>
import Button from './frontend/components/Button.vue';
import ProductCard from './frontend/components/ProductCard.vue';
import CategoryPill from './frontend/components/CategoryPill.vue';
import SpecialOffer from './frontend/components/SpecialOffer.vue';
import Header from './frontend/components/Header.vue';
import BottomNav from './frontend/components/BottomNav.vue';
import ProductosDestacados from './frontend/components/ProductosDestacados.vue';
import ProductosOferta from './frontend/components/ProductosOferta.vue';
import Footer from './frontend/components/Footer.vue';
export default {
  name: "App",
  components: {
    Button,
    ProductCard,
    CategoryPill,
    SpecialOffer,
    Header,
    BottomNav,
    ProductosDestacados,
    ProductosOferta,
    Footer
  },
  data() {
    return {
      activeNav: 'home'
    };
  }
};
</script>




<style scoped></style>
