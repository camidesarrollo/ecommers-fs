<template>
  <section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Categorías</h2>

      <swiper
        :slides-per-view="2"
        :space-between="16"
        :breakpoints="breakpoints"
        class="pb-6"
      >
        <swiper-slide v-for="(cat, index) in categorias" :key="index">
          <div
            class="flex flex-col items-center justify-center rounded-xl p-4 text-white font-semibold cursor-pointer transform hover:scale-105 transition"
            :class="cat.bgClass"
          >
            <div class="text-4xl mb-2">{{ cat.emoji }}</div>
            <span>{{ cat.name }}</span>
          </div>
        </swiper-slide>
      </swiper>
    </div>
  </section>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';

const categorias = [
  { name: 'Frutos Secos', emoji: '🥜', bgClass: 'bg-gradient-to-br from-yellow-400 to-yellow-500' },
  { name: 'Frutas Deshidratadas', emoji: '🍑', bgClass: 'bg-gradient-to-br from-pink-400 to-pink-500' },
  { name: 'Aceitunas y Olivas', emoji: '🫒', bgClass: 'bg-gradient-to-br from-green-500 to-green-600' },
  { name: 'Chocolates y Dulces', emoji: '🍫', bgClass: 'bg-gradient-to-br from-purple-500 to-pink-500' },
  { name: 'Cereales y Legumbres', emoji: '🌾', bgClass: 'bg-gradient-to-br from-yellow-600 to-yellow-700' },
  { name: 'Harinas y Preparación', emoji: '🥣', bgClass: 'bg-gradient-to-br from-orange-400 to-orange-500' },
  { name: 'Café, Té y Especias', emoji: '☕', bgClass: 'bg-gradient-to-br from-gray-600 to-gray-700' },
  { name: 'Conservas y Vegetales', emoji: '🥬', bgClass: 'bg-gradient-to-br from-green-400 to-green-500' },
  { name: 'Snacks y Otros', emoji: '🍪', bgClass: 'bg-gradient-to-br from-red-400 to-red-500' },
];

const breakpoints = {
  640: { slidesPerView: 3 },
  768: { slidesPerView: 4 },
  1024: { slidesPerView: 5 },
};
</script>

<style scoped>
/* Swiper se maneja por defecto, pero puedes personalizar flechas si quieres */
</style>
