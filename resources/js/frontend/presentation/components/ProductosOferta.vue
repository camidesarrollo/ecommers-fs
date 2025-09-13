<template>
  <section v-if="historiesVigentes.length > 0" class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Productos en Oferta</h2>
        <a class="text-blue-500 font-semibold" href="/productoList">Ver todos</a>
      </div>

      <!-- Carrusel -->
      <Swiper
        :slides-per-view="1"
        :space-between="20"
        :breakpoints="breakpoints"
        :navigation="historiesVigentes.length > 4 ? navigationOptions : false"
        pagination
        class="pb-6"
      >
        <SwiperSlide v-for="(history, index) in historiesVigentes" :key="index">
          <ProductCard
            :title="history.typeProduct"
            :subtitle="history.variant"
            :price="history.sale_price"
            :oldPrice="history.price"
            :discount="history.price && history.sale_price
              ? Math.round(((history.price - history.sale_price) / history.price) * 100)
              : 0"
            :image="history.imagen"
            :bgClass="variantes[Math.floor(Math.random() * variantes.length)].bgClass"
            :buttonType="variantes[Math.floor(Math.random() * variantes.length)].buttonType"
          />
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>

<script setup lang="ts">
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import ProductCard from './ProductCard.vue';
import { ref, computed, onMounted } from 'vue';
import { useProductVariantPriceHistory } from '../../application/callbacks/product.variant.price.history.cb';

const breakpoints = {
  640: { slidesPerView: 1 },
  768: { slidesPerView: 2 },
  1024: { slidesPerView: 4 },
};

const navigationOptions = {
  nextEl: '.swiper-button-next-custom',
  prevEl: '.swiper-button-prev-custom'
};

// Usamos el callback para traer el historial de precios
const { histories, traerHistories } = useProductVariantPriceHistory();

// Filtramos solo los registros vigentes
const historiesVigentes = computed(() => {
  const hoy = new Date();
  return histories.value.filter(h => h.end_date != null && new Date(h.end_date) > hoy);
});

// Traer los datos al montar el componente
onMounted(() => {
  traerHistories();
});

const variantes = [
  {
    bgClass: "bg-yellow-100",
    buttonType: "success"
  },
  {
    bgClass: "bg-yellow-50",
    buttonType: "purple"
  },
  {
    bgClass: "bg-green-100",
    buttonType: "blue"
  },
  {
    bgClass: "bg-pink-100",
    buttonType: "red"
  },
  {
    bgClass: "bg-orange-100",
    buttonType: "green"
  }
];
</script>
