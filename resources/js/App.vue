<template>
  <div class="min-h-screen bg-gradient-to-br from-yellow-100 to-yellow-200 pb-24">

    <!-- Header -->
    <Header/>
    <!-- Hero -->
    <section class="relative text-center py-20">
      <div class="absolute top-0 left-0 w-full h-full opacity-10">
        <div class="absolute top-16 left-10 text-6xl animate-bounce">🌰</div>
        <div class="absolute top-36 right-8 text-5xl animate-bounce delay-1000">🥜</div>
        <div class="absolute bottom-20 left-5 text-4xl animate-bounce delay-2000">🌰</div>
      </div>
      <div class="relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Frutos Secos Premium</h1>
        <p class="text-lg md:text-xl mb-6 text-gray-700/90">Naturales, frescos y llenos de sabor</p>
        <Button type="primary" class="text-white px-8 py-3">Explorar Productos</Button>
      </div>
    </section>

    <!-- Categories -->
    <section class="py-10">
      <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Categorías</h2>
        <div class="grid grid-cols-2 gap-4">
          <CategoryPill name="Almendras" emoji="🥜" bgClass="bg-gradient-to-br from-yellow-400 to-yellow-500" />
          <CategoryPill name="Nueces" emoji="🌰" bgClass="bg-gradient-to-br from-yellow-300 to-yellow-400" />
          <CategoryPill name="Pistachos" emoji="🥨" bgClass="bg-gradient-to-br from-green-400 to-green-500" />
          <CategoryPill name="Mix Premium" emoji="🥜" bgClass="bg-gradient-to-br from-pink-400 to-pink-500" />
        </div>
      </div>
    </section>

    <!-- Featured Products -->
    <section class="py-10 bg-white">
      <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Productos Destacados</h2>
          <button class="text-blue-500 font-semibold">Ver todos</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <ProductCard
            title="Almendras Tostadas Premium"
            subtitle="500g - Origen California"
            price="12.99"
            oldPrice="15.99"
            discount="20"
            emoji="🥜"
            bgClass="bg-yellow-100"
            buttonType="success"
          />
          <ProductCard
            title="Mix de Nueces Deluxe"
            subtitle="300g - Selección especial"
            price="18.50"
            emoji="🌰"
            bgClass="bg-yellow-50"
            buttonType="purple"
          />
          <ProductCard
            title="Pistachos Salados"
            subtitle="250g - Origen Turquía"
            price="22.00"
            emoji="🥨"
            bgClass="bg-green-100"
            buttonType="blue"
          />
        </div>
      </div>
    </section>

    <!-- Special Offer -->
    <section class="py-10">
      <div class="container mx-auto">
        <SpecialOffer
          title="¡Oferta Especial!"
          subtitle="Compra 3 productos y llévate el 4to GRATIS"
          buttonText="Aprovechar Oferta"
        />
      </div>
    </section>

    <!-- Bottom Navigation -->
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

export default {
  name: "App",
  components: {
    Button,
    ProductCard,
    CategoryPill,
    SpecialOffer,
    Header,
    BottomNav
  },
  data() {
    return {
      activeNav: 'home'
    };
  }
};
</script>




<style scoped>
</style>
