<template>
  <section v-if="productosRelacionados.length > 0" class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Productos Relacionados</h2>
        <a :href="`/productos?categoria=${categoria}`" class="text-blue-500 font-semibold hover:underline">
          Ver más
        </a>
      </div>

      <!-- Carrusel -->
      <Swiper
        :slides-per-view="1"
        :space-between="20"
        :breakpoints="breakpoints"
        :navigation="productosRelacionados.length > 4 ? navigationOptions : false"
        pagination
        class="pb-6"
      >
        <SwiperSlide v-for="producto in productosRelacionados" :key="producto.id">
          <ProductCard
            :title="producto.title"
            :subtitle="producto.subtitle"
            :price="producto.price"
            :oldPrice="producto.oldPrice"
            :image="producto.image ?? ''"
            :bgClass="getRandomVariant().bgClass"
            :buttonType="getRandomVariant().buttonType"
            :emoji="producto.emoji"
          />
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import ProductCard from './ProductCard.vue';

const props = defineProps({
  categoria: { type: String, required: true },
  productoActual: { type: Number, required: true }
});

const breakpoints = {
  640: { slidesPerView: 1 },
  768: { slidesPerView: 2 },
  1024: { slidesPerView: 3 },
};

const navigationOptions = {
  nextEl: '.swiper-button-next-custom',
  prevEl: '.swiper-button-prev-custom'
};

// Simulación de productos relacionados
const todosLosProductos = [
  { id: 2, title: "Nueces Premium", subtitle: "400g - Selección", price: 14.99, oldPrice: 18.99, emoji: "🌰", categoria: "frutos-secos" },
  { id: 3, title: "Pistachos Naturales", subtitle: "300g - Natural", price: 19.99, emoji: "🥜", categoria: "frutos-secos" },
  { id: 4, title: "Avellanas Tostadas", subtitle: "250g - Tostadas", price: 16.50, emoji: "🌰", categoria: "frutos-secos" },
    { id: 2, title: "Nueces Premium", subtitle: "400g - Selección", price: 14.99, oldPrice: 18.99, emoji: "🌰", categoria: "frutos-secos" },
  { id: 3, title: "Pistachos Naturales", subtitle: "300g - Natural", price: 19.99, emoji: "🥜", categoria: "frutos-secos" },
  { id: 4, title: "Avellanas Tostadas", subtitle: "250g - Tostadas", price: 16.50, emoji: "🌰", categoria: "frutos-secos" },
    { id: 2, title: "Nueces Premium", subtitle: "400g - Selección", price: 14.99, oldPrice: 18.99, emoji: "🌰", categoria: "frutos-secos" },
  { id: 3, title: "Pistachos Naturales", subtitle: "300g - Natural", price: 19.99, emoji: "🥜", categoria: "frutos-secos" },
  { id: 4, title: "Avellanas Tostadas", subtitle: "250g - Tostadas", price: 16.50, emoji: "🌰", categoria: "frutos-secos" },
    { id: 2, title: "Nueces Premium", subtitle: "400g - Selección", price: 14.99, oldPrice: 18.99, emoji: "🌰", categoria: "frutos-secos" },
  { id: 3, title: "Pistachos Naturales", subtitle: "300g - Natural", price: 19.99, emoji: "🥜", categoria: "frutos-secos" },
  { id: 4, title: "Avellanas Tostadas", subtitle: "250g - Tostadas", price: 16.50, emoji: "🌰", categoria: "frutos-secos" },
  // Agrega más si deseas
];

const productosRelacionados = computed(() =>
  todosLosProductos
    .filter(p => p.categoria === props.categoria && p.id !== props.productoActual)
    .slice(0, 12)
);

// Variantes de estilos
const variantes = [
  { bgClass: "bg-yellow-100", buttonType:  "agregar" },
  { bgClass: "bg-yellow-50", buttonType: "agregar" },
  { bgClass: "bg-green-100", buttonType: "agregar" },
  { bgClass: "bg-pink-100", buttonType: "agregar" },
  { bgClass: "bg-orange-100", buttonType: "green" }
];

const getRandomVariant = () => variantes[Math.floor(Math.random() * variantes.length)];
</script>
