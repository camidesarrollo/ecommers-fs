<template>
  <section v-if="productosRecientes.length > 0" class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Productos Recientes</h2>
        <a class="text-blue-500 font-semibold" href="/productoList">Ver todos</a>
      </div>

      <!-- Carrusel -->
      <Swiper
        :slides-per-view="1"
        :space-between="20"
        :breakpoints="breakpoints"
        :navigation="productosRecientes.length > 4 ? navigationOptions : false"
        pagination
        class="pb-6"
      >
        <SwiperSlide v-for="(producto, index) in productosRecientes" :key="index">
          <ProductCard
            :title="producto.name"
            :subtitle="producto.sku"
            :price="producto.price"
            :oldPrice="producto.sale_price"
            :discount="producto.price && producto.sale_price
              ? Math.round(((producto.price - producto.sale_price) / producto.price) * 100)
              : 0"
            :image="producto.images?.[0] ?? ''"
            :bgClass="getRandomVariant().bgClass"
            :buttonType="getRandomVariant().buttonType"
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

import { ref, computed, onMounted } from 'vue';
import ProductCard from './ProductCard.vue';
import { useProductList } from '../../application/callbacks/product.cb';

const breakpoints = {
  640: { slidesPerView: 1 },
  768: { slidesPerView: 2 },
  1024: { slidesPerView: 4 },
};

const navigationOptions = {
  nextEl: '.swiper-button-next-custom',
  prevEl: '.swiper-button-prev-custom'
};

// --- Productos recientes ---
const { productos, listarProductos } = useProductList(); 
// productos: ref([]), listarProductos: función API

// Computed seguro, protege si productos.value aún no existe
const productosRecientes = computed(() => {
  console.log(productos?.value);
  if (!productos?.value) return [];
  return productos.value
    .filter(p => p.is_in_stock) // solo productos en stock
    .sort((a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime()); // más recientes primero
});

// Cargar productos al montar el componente
onMounted(async () => {
  await listarProductos({
    search: '',
    stockStatus: 'in_stock',
    orderBy: 'created_at',
    orderDirection: 'desc',
    perPage: 20
  });
});

// Variantes de estilos
const variantes = [
  { bgClass: "bg-yellow-100", buttonType: "success" },
  { bgClass: "bg-yellow-50", buttonType: "purple" },
  { bgClass: "bg-green-100", buttonType: "blue" },
  { bgClass: "bg-pink-100", buttonType: "red" },
  { bgClass: "bg-orange-100", buttonType: "green" }
];

// Función para obtener variante aleatoria
const getRandomVariant = () => variantes[Math.floor(Math.random() * variantes.length)];
</script>
