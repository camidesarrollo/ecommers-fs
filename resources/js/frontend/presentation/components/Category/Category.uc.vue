<template>
  <section class="py-10 bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Categorías</h2>

      <swiper :slides-per-view="2" :space-between="16" :breakpoints="breakpoints" class="pb-6">
        <swiper-slide v-for="(cat, index) in categorias" :key="index">
          <div
            class="relative flex flex-col items-center justify-center rounded-2xl p-6 cursor-pointer transform hover:scale-105 transition-all shadow-lg bg-white/20 backdrop-blur-md border border-white/30 hover:shadow-2xl hover:bg-gradient-to-br hover:from-amber-400/90 hover:to-orange-500/90"
          >
            <!-- Badge de cantidad -->
            <div class="absolute top-2 right-2 bg-white text-gray-800 text-xs font-bold px-2 py-1 rounded-full shadow">
              {{ cat.product_count }} productos
            </div>

            <!-- Badge de "Nuevo" -->
            <div
              v-if="cat.is_new"
              class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow"
            >
              Nuevo
            </div>

            <!-- Imagen -->
            <div class="mb-3">
              <img v-if="cat.image" :src="cat.image" alt="" class="w-14 h-14 rounded-full shadow-md" />
            </div>

            <!-- Nombre -->
            <span class="text-lg font-bold text-white drop-shadow">{{ cat.name }}</span>

            <!-- Descripción -->
            <span class="text-sm text-white/90 italic mb-1">{{ cat.description }}</span>

            <!-- CTA -->
            <span class="text-xs text-white/80 underline">Ver más</span>
          </div>
        </swiper-slide>
      </swiper>
    </div>
  </section>
</template>

<script setup lang="ts">
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';

// 👇 Comentamos el uso real de API para el demo
import { useCategory } from "../../../application/callbacks/category.cb";
const { categorias } = useCategory();

// Breakpoints de Swiper
const breakpoints = {
  640: { slidesPerView: 3 },
  768: { slidesPerView: 4 },
  1024: { slidesPerView: 5 },
};
</script>
