<!--
estrella es el más vendido absoluto
-->

<template>
  <section class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Mix del Mes / Producto Estrella</h2>
        <a class="text-blue-500 font-semibold" href="/productoList">Ver todos</a>
      </div>

      <!-- Carrusel de productos estrella -->
      <Swiper
        :slides-per-view="1"
        :space-between="20"
        :breakpoints="breakpoints"
        :navigation="productos.length > 3 ? navigationOptions : false"
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
            :highlightText="producto.highlightText"
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
  640: { slidesPerView: 1 },
  768: { slidesPerView: 2 },
  1024: { slidesPerView: 3 },
};

// Productos estrella seleccionados según criterios
const productos = [
  {
    title: "Almendras Tostadas Premium",
    subtitle: "500g - Origen California",
    price: 12.99,
    oldPrice: 15.99,
    discount: 20,
    emoji: "🥜",
    bgClass: "bg-yellow-100",
    buttonType: "success",
    highlightText: "Stock limitado, aprovecha antes que se acabe!"
  },
  {
    title: "Mix de Nueces Deluxe",
    subtitle: "300g - Selección especial",
    price: 18.50,
    oldPrice: 22.00,
    discount: 16,
    emoji: "🌰",
    bgClass: "bg-yellow-50",
    buttonType: "purple",
    highlightText: "Top ventas del mes, ¡no te lo pierdas!"
  },
  {
    title: "Pistachos Salados",
    subtitle: "250g - Origen Turquía",
    price: 22.00,
    oldPrice: 25.50,
    discount: 14,
    emoji: "🥨",
    bgClass: "bg-green-100",
    buttonType: "blue",
    highlightText: "Popularidad reciente, edición limitada"
  }
];

const navigationOptions = {
  nextEl: '.swiper-button-next-custom',
  prevEl: '.swiper-button-prev-custom'
};
</script>
