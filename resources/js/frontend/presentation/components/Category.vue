<template>
  <section v-if="categorias.length > 0" class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Categorías</h2>
       
      <swiper :slides-per-view="2" :space-between="16" :breakpoints="breakpoints" class="pb-6">
        <swiper-slide v-for="(cat, index) in categorias" :key="index">
          <div
            :class="[
              'relative flex flex-col items-center justify-center rounded-2xl p-6 cursor-pointer transform transition-all shadow-lg border border-white/30 hover:shadow-2xl hover:scale-105',
              cat.bgClass
            ]"
          >
            <!-- Badge de cantidad -->
            <div class="absolute top-2 right-2 bg-white/90 text-gray-800 text-xs font-bold px-2 py-1 rounded-full shadow backdrop-blur-sm">
              {{ cat.productCount }} productos
            </div>
             
            <!-- Badge de "Nuevo" -->
            <div
              v-if="cat.isNew"
              class="absolute top-2 left-2 bg-burgundy-red text-white text-xs font-bold px-2 py-1 rounded-full shadow"
            >
              Nuevo
            </div>
             
            <!-- Imagen -->
            <div class="mb-3">
              <img v-if="cat.image" :src="cat.image" alt="" class="w-14 h-14 rounded-full shadow-md border-2 border-white/50" />
            </div>
             
            <!-- Nombre -->
            <span class="text-lg font-bold text-white drop-shadow-lg text-center">{{ cat.name }}</span>
             
            <!-- Descripción -->
            <span class="text-sm text-white/90 italic mb-1 text-center">{{ cat.shortDescription }}</span>
             
            <!-- CTA -->
            <span class="text-xs text-white/95 underline mt-2 cursor-pointer hover:text-white transition-colors">Ver más</span>
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
import { useCategory } from "../../application/callbacks/category.cb";
const { categorias } = useCategory();

// Breakpoints de Swiper
const breakpoints = {
  320: { slidesPerView: 1 },
  640: { slidesPerView: 2 },
  768: { slidesPerView: 3 },
  1024: { slidesPerView: 3 },
  1440: { slidesPerView: 4 },
  
};

</script>