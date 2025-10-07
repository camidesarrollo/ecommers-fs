<!-- En un archivo separado: ServiciosCard.vue -->
<template>
  <section :class="isVertical ? 'space-y-4' : 'py-10 bg-gradient-to-tr from-amber-200 via-orange-100 to-yellow-50'">
    <div :class="isVertical ? '' : 'container mx-auto px-4 sm:px-6 lg:px-8'">

      <!-- Título para versión vertical -->
      <h3 v-if="isVertical" class="text-lg font-bold text-gray-800 mb-4">Nuestros Servicios</h3>

      <div :class="isVertical ? 'space-y-4' : 'grid grid-cols-1 md:grid-cols-3 gap-6'">
        <div v-for="(item, index) in servicios" :key="index" :class="cardClass">
          <div :class="isVertical ? 'flex items-start gap-3' : 'flex justify-center mb-4'">
            <img :src="item.imagen" alt="" :class="isVertical ? 'w-12 h-12' : 'w-10 h-10'" />
            <div v-if="isVertical" class="flex-1">
              <h4 class="font-bold text-sm mb-1">{{ item.titulo }}</h4>
              <p class="text-xs text-gray-600">{{ item.descripcion }}</p>
            </div>
          </div>
          <div v-if="!isVertical">
            <h3 class="text-xl font-bold mb-2">{{ item.titulo }}</h3>
            <p class="text-sm">{{ item.descripcion }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  orientation: {
    type: String,
    default: 'horizontal', // 'horizontal' o 'vertical'
    validator: (value) => ['horizontal', 'vertical'].includes(value)
  }
});

const isVertical = computed(() => props.orientation === 'vertical');

const cardClass = computed(() =>
  isVertical.value
    ? 'bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition'
    : 'bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition'
);

const servicios = [
  {
    titulo: "DESPACHO GRATIS",
    descripcion: "Por compras desde $100.000 + IVA",
    imagen: "/img/icons8-en-tránsito.gif"
  },
  {
    titulo: "PRODUCTOS DE CALIDAD",
    descripcion: "Con altos estándares de exigencia",
    imagen: "/img/icons8-garantía.gif"
  },
  {
    titulo: "PAGO SEGURO",
    descripcion: "Aceptamos todas las tarjetas",
    imagen: "/img/icons8-terminal-punto-de-venta.gif"
  }
];
</script>