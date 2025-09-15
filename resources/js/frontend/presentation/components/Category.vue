<template>
  <section v-if="categorias.length > 0" class="py-10 bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Categorías</h2>
       
      <swiper :slides-per-view="2" :space-between="16" :breakpoints="breakpoints" class="pb-6">
        <swiper-slide v-for="(cat, index) in categorias" :key="index">
          <div
            :class="[
              'relative flex flex-col items-center justify-center rounded-2xl p-6 cursor-pointer transform transition-all shadow-lg border border-white/30 hover:shadow-2xl hover:scale-105',
              getCategoryColor(cat.name)
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
  640: { slidesPerView: 3 },
  768: { slidesPerView: 4 },
  1024: { slidesPerView: 5 },
};

// Función para asignar color representativo según categoría usando los colores del negocio
const getCategoryColor = (name: string) => {
  const colorMap: Record<string, string> = {
    "Aceitunas y Olivas": "bg-gradient-to-br from-olive-green to-mint-green",
    "Café, Té y Especias": "bg-gradient-to-br from-dark-chocolate to-nut-brown",
    "Cereales y Legumbres": "bg-gradient-to-br from-golden-yellow to-beige",
    "Chocolates y Dulces": "bg-gradient-to-br from-nut-brown to-dark-chocolate",
    "Conservas y Vegetales": "bg-gradient-to-br from-olive-green to-mint-green",
    "Frutas Deshidratadas": "bg-gradient-to-br from-burgundy-red to-orange-warm",
    "Frutos Secos": "bg-gradient-to-br from-nut-brown to-golden-yellow",
    "Harinas y Preparación": "bg-gradient-to-br from-beige to-golden-yellow",
    "Snacks y Otros": "bg-gradient-to-br from-orange-warm to-burgundy-red",
    
    // Categorías adicionales manteniendo coherencia con los colores del negocio
    "Semillas y Granos": "bg-gradient-to-br from-golden-yellow to-nut-brown",
    "Condimentos y Salsas": "bg-gradient-to-br from-burgundy-red to-olive-green",
    "Productos Orgánicos": "bg-gradient-to-br from-mint-green to-olive-green",
    "Bebidas Naturales": "bg-gradient-to-br from-mint-green to-beige",
    "Superfoods": "bg-gradient-to-br from-burgundy-red to-golden-yellow",
    "Productos Sin Gluten": "bg-gradient-to-br from-beige to-mint-green",
    "Endulzantes Naturales": "bg-gradient-to-br from-golden-yellow to-orange-warm",
    "Aceites y Vinagres": "bg-gradient-to-br from-olive-green to-golden-yellow",
  };
  
  return colorMap[name] ?? "bg-gradient-to-br from-gray-light to-gray-dark"; // Color default
};
</script>