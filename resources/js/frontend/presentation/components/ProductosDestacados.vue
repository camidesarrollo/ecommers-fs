<template>
  <section :class="containerClass">
    <div :class="isVertical ? '' : 'container mx-auto px-4 sm:px-6 lg:px-8'">
      
      <!-- Encabezado -->
      <div :class="headerClass">
        <h2 :class="isVertical ? 'text-lg font-bold text-gray-800' : 'text-2xl font-bold text-gray-800'">
          Productos Destacados
        </h2>
        <a v-if="!isVertical" class="text-blue-500 font-semibold text-sm hover:underline" href="/productos">
          Ver todos
        </a>
      </div>

      <!-- Layout Vertical -->
      <div v-if="isVertical" class="space-y-4">
        <a
          v-for="(producto, index) in productosLimitados"
          :key="index"
          :href="`/producto/${producto.id}`"
          class="block bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden"
        >
          <div class="flex gap-3 p-3">
            <div :class="`${producto.bgClass} rounded-lg flex items-center justify-center flex-shrink-0`" style="width: 80px; height: 80px;">
              <span class="text-3xl">{{ producto.emoji }}</span>
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-semibold text-sm text-gray-800 mb-1 line-clamp-2">{{ producto.title }}</h3>
              <p class="text-xs text-gray-500 mb-2">{{ producto.subtitle }}</p>
              <div class="flex items-baseline gap-2">
                <span class="text-base font-bold text-yellow-600">${{ producto.price }}</span>
                <span v-if="producto.oldPrice" class="text-xs text-gray-400 line-through">${{ producto.oldPrice }}</span>
              </div>
            </div>
          </div>
        </a>
        <a 
          href="/productos"
          class="block text-center text-sm text-blue-500 hover:underline font-medium py-2"
        >
          Ver todos →
        </a>
      </div>

      <!-- Layout Horizontal (Carrusel) -->
      <Swiper
        v-else
        :slides-per-view="1"
        :space-between="20"
        :breakpoints="breakpoints"
        :navigation="productos.length > 4"
        pagination
        class="pb-8"
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
          />
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  orientation: {
    type: String,
    default: 'horizontal',
    validator: (value) => ['horizontal', 'vertical'].includes(value)
  },
  limite: {
    type: Number,
    default: 4
  }
});

const isVertical = computed(() => props.orientation === 'vertical');

const containerClass = computed(() => 
  isVertical.value ? '' : 'py-10 bg-white'
);

const headerClass = computed(() => 
  isVertical.value 
    ? 'flex justify-between items-center mb-4' 
    : 'flex justify-between items-center mb-6'
);

const breakpoints = {
  640: { slidesPerView: 1 },
  768: { slidesPerView: 2 },
  1024: { slidesPerView: 4 },
};

const productos = [
  {
    id: 1,
    title: "Almendras Tostadas Premium",
    subtitle: "500g - Origen California",
    price: 12.99,
    oldPrice: 15.99,
    discount: 20,
    emoji: "🥜",
    bgClass: "bg-yellow-100",
    buttonType: "agregar"
  },
  {
    id: 2,
    title: "Mix de Nueces Deluxe",
    subtitle: "300g - Selección especial",
    price: 18.50,
    emoji: "🌰",
    bgClass: "bg-yellow-50",
    buttonType: "agregar"
  },
  {
    id: 3,
    title: "Pistachos Salados",
    subtitle: "250g - Origen Turquía",
    price: 22.00,
    emoji: "🥨",
    bgClass: "bg-green-100",
    buttonType: "agregar"
  },
  {
    id: 4,
    title: "Nueces de Brasil",
    subtitle: "400g - Premium",
    price: 25.00,
    emoji: "🌰",
    bgClass: "bg-pink-100",
    buttonType: "agregar"
  },
  {
    id: 5,
    title: "Castañas de Cajú",
    subtitle: "350g - Orgánico",
    price: 20.00,
    emoji: "🌰",
    bgClass: "bg-orange-100",
    buttonType: "agregar"
  }
];

const productosLimitados = computed(() => 
  productos.slice(0, props.limite)
);
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

