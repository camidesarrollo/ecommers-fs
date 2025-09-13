<template>
  <section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Categorías</h2>

      <swiper :slides-per-view="2" :space-between="16" :breakpoints="breakpoints" class="pb-6">
        <swiper-slide v-for="(cat, index) in categorias" :key="index">
          <div
            :class="[
              'flex flex-col items-center justify-center rounded-xl p-4 text-white font-semibold cursor-pointer transform hover:scale-105 transition',
              cat.bgClass
            ]"
          >
            <div class="text-4xl mb-2">
              <img v-if="cat.image" :src="cat.image" alt="" class="w-10 h-10" />
            </div>
            <span>{{ cat.name }}</span>
          </div>
        </swiper-slide>
      </swiper>
    </div>
  </section>
</template>

<script setup lang="ts">
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';

import { useCategory } from "../../../application/callbacks/category.cb";

// Usamos el hook que creamos
const { categorias } = useCategory();

// Breakpoints de Swiper
const breakpoints = {
  640: { slidesPerView: 3 },
  768: { slidesPerView: 4 },
  1024: { slidesPerView: 5 },
};
</script>
