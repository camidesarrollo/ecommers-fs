<template>
  <section class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Productos Oferta</h2>
        <button class="text-blue-500 font-semibold">Ver todos</button>
      </div>

      <!-- Carrusel -->
      <Swiper
        :slides-per-view="1"
        :space-between="20"
        :breakpoints="breakpoints"
        :navigation="productos.length > 4 ? navigationOptions : false"
        pagination
        class="pb-6"
      >
        <SwiperSlide v-for="(producto, index) in productos" :key="index">
          <ProductCard
            :title="producto.title"
            :subtitle="producto.subtitle"
            :price="producto.price"
            :oldPrice="producto.oldPrice"
            :discount="producto.discount"
            :emoji="producto.emoji"
            :bgClass="producto.bgClass"
            :buttonType="producto.buttonType"
          />
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import ProductCard from './ProductCard.vue';

const breakpoints = {
  640: { slidesPerView: 1 },   // Móviles
  768: { slidesPerView: 2 },   // Tablets
  1024: { slidesPerView: 4 },  // Escritorio
};

// Lista de productos
const productos = [
  {
    title: "Almendras Tostadas Premium",
    subtitle: "500g - Origen California",
    price: "12.99",
    oldPrice: "15.99",
    discount: "20",
    emoji: "🥜",
    bgClass: "bg-yellow-100",
    buttonType: "success"
  },
  {
    title: "Mix de Nueces Deluxe",
    subtitle: "300g - Selección especial",
    price: "18.50",
    emoji: "🌰",
    bgClass: "bg-yellow-50",
    buttonType: "purple"
  },
  {
    title: "Pistachos Salados",
    subtitle: "250g - Origen Turquía",
    price: "22.00",
    emoji: "🥨",
    bgClass: "bg-green-100",
    buttonType: "blue"
  },
  {
    title: "Nueces de Brasil",
    subtitle: "400g - Selección premium",
    price: "25.00",
    emoji: "🌰",
    bgClass: "bg-pink-100",
    buttonType: "red"
  },
  {
    title: "Castañas de Cajú",
    subtitle: "350g - Orgánico",
    price: "20.00",
    emoji: "🌰",
    bgClass: "bg-orange-100",
    buttonType: "green"
  }
];

// Opciones de navegación personalizadas
const navigationOptions = {
  nextEl: '.swiper-button-next-custom',
  prevEl: '.swiper-button-prev-custom'
};
</script>

