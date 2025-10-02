<template>
  <section v-if="historiesVigentes.length > 0" class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Productos en Oferta / Flash</h2>
        <a class="text-blue-500 font-semibold" href="/productoList">Ver todos</a>
      </div>

      <!-- Carrusel -->
      <Swiper :slides-per-view="1" :space-between="20" :breakpoints="breakpoints"
        :navigation="historiesVigentes.length > 4 ? navigationOptions : false" pagination class="pb-6">
        <SwiperSlide v-for="(history, index) in historiesVigentes" :key="index">
          <ProductCard :title="history.typeProduct" :subtitle="history.variant" :price="history.sale_price"
            :oldPrice="history.price" :discount="computeDiscount(history.price, history.sale_price)"
            :image="history.imagen" :bgClass="variantes[Math.floor(Math.random() * variantes.length)].bgClass"
            :buttonType="variantes[Math.floor(Math.random() * variantes.length)].buttonType">
            <!-- Sellos visuales -->
            <template #badge>
              <div class="absolute top-2 left-2 flex flex-col gap-1">
                <span v-if="history.sale_price && history.price"
                  class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow">
                  -{{ computeDiscount(history.price, history.sale_price) }}%
                </span>
                <span v-if="isSoloHoy(history)"
                  class="bg-yellow-400 text-gray-800 text-xs font-bold px-2 py-1 rounded shadow">
                  Solo hoy
                </span>
                <span v-if="Number(history.stock_quantity) <= 5"
                  class="bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded shadow">
                  Quedan pocas unidades
                </span>
              </div>
            </template>

            <!-- Botón rápido -->
            <template #button>
              <UiButtons tipo="agregar" :accion="() => addToCart(history)" label="Agregar al carrito" class="w-full" />
            </template>
          </ProductCard>
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
import UiButtons from '../components/Buttons/UiButtons.vue';
import { ref, computed, onMounted } from 'vue';
import { useProductVariantPriceHistory } from '../../application/callbacks/product.variant.price.history.cb';
import type { IProductVariantPriceHistoryDtoOutput } from "../../domain/dtos/output/i.product.variant.price.history.dto.output";

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
  { bgClass: "bg-yellow-100", buttonType: "agregar" },
  { bgClass: "bg-yellow-50", buttonType: "purple" },
  { bgClass: "bg-green-100", buttonType: "blue" },
  { bgClass: "bg-pink-100", buttonType: "red" },
  { bgClass: "bg-orange-100", buttonType: "green" }
];

// Función para calcular el descuento %
function computeDiscount(price: number, salePrice?: number) {
  if (!price || !salePrice) return 0;
  return Math.round(((price - salePrice) / price) * 100);
}

// Determina si el producto es "Solo hoy" (vigencia termina hoy)
function isSoloHoy(history: IProductVariantPriceHistoryDtoOutput) {
  if (!history.end_date) return false;
  const hoy = new Date();
  const endDate = new Date(history.end_date);
  return hoy.toDateString() === endDate.toDateString();
}

// Simulación agregar al carrito
function addToCart(history: IProductVariantPriceHistoryDtoOutput) {
  console.log('Agregar al carrito:', history);
}
</script>
