<template>
  <section v-if="productosRecientes.length > 0" class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Novedades / Últimos Productos</h2>
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

import { computed, onMounted } from 'vue';
import ProductCard from './ProductCard.vue';
import { useProductList } from '../../application/callbacks/product.cb';
import { toRaw } from 'vue';

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
const { productos, listarProductos, loading, error } = useProductList();

// Computed seguro, protege si productos.value aún no existe
const productosRecientes = computed(() => {
  const rawProductos = toRaw(productos?.value) || [];

  console.log(
    `[${new Date().toLocaleTimeString()}] Productos en computed:`,
    rawProductos
  );

  if (!Array.isArray(rawProductos)) {
    console.log('No hay productos o no es array');
    return [];
  }

  // return rawProductos
  //   .filter(p => p.is_in_stock) // solo productos en stock
  //   .sort((a, b) => {
  //     // Ordenar por fecha de creación (más recientes primero)
  //     const dateA = new Date(a.created_at || 0).getTime();
  //     const dateB = new Date(b.created_at || 0).getTime();
  //     return dateB - dateA;
  //   })
  //   .slice(0, 12); // Limitar a 12 productos recientes

  return rawProductos;
});

// Cargar productos al montar el componente
onMounted(async () => {
  console.log('Componente montado, cargando productos...');
  await listarProductos();
});

// Variantes de estilos
const variantes = [
  { bgClass: "bg-yellow-100", buttonType:  "agregar" },
  { bgClass: "bg-yellow-50", buttonType: "agregar" },
  { bgClass: "bg-green-100", buttonType: "agregar" },
  { bgClass: "bg-pink-100", buttonType: "agregar" },
  { bgClass: "bg-orange-100", buttonType: "green" }
];

// Función para obtener variante aleatoria
const getRandomVariant = () => variantes[Math.floor(Math.random() * variantes.length)];
</script>
