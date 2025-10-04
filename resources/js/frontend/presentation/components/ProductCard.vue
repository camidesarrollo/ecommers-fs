<template>
  <div class="relative rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
    <!-- Badge de descuento -->
    <span v-if="discount"
      class="absolute top-4 left-4 bg-red-500 text-white font-bold px-2 py-1 rounded-lg animate-pulse">
      -{{ discount }}%
    </span>

    <!-- Imagen o Emoji -->
    <div :class="['h-48 flex items-center justify-center text-5xl', bgClass]">
      <img v-if="image" :src="image" alt="Imagen del producto" class="object-contain h-full w-full" />
      <div v-else class="animate-pulse-slow">{{ emoji }}</div>
    </div>

    <!-- Detalles -->
    <div class="p-4">
      <h5 class="font-bold text-lg text-gray-800">{{ title }}</h5>
      <p class="text-sm text-gray-500 mb-3">{{ subtitle }}</p>
      <div class="justify-between items-center">
        <div class="mb-4">
          <span class="text-green-600 font-bold text-lg">${{ price }}</span>
          <span v-if="oldPrice" class="text-gray-400 line-through ml-2">${{ oldPrice }}</span>
        </div>

        <!-- Botón corregido -->
        <UiButtons :tipo="buttonType" :label="buttonText" :accion="handleAddToCart" :icono="buttonIcon" :loading="false"
          :isFormValid="true" />
      </div>
    </div>
  </div>
</template>

<script>
import UiButtons from './Buttons/UiButtons.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCartPlus  } from '@fortawesome/free-solid-svg-icons';
library.add(faCartPlus );

export default {
  components: { UiButtons },
  props: {
    title: String,
    subtitle: String,
    price: Number,
    oldPrice: Number,
    discount: Number,
    emoji: String,
    image: String,
    bgClass: String,
    buttonText: { type: String, default: 'Agregar' },
    buttonType: { type: String, default: 'agregar' },
    buttonIcon: { type: String, default: 'cart-plus' }
  },
  emits: ['add-to-cart'],
  setup(props, { emit }) {
    const handleAddToCart = () => {
      emit('add-to-cart', {
        title: props.title,
        price: props.price,
        image: props.image
      });
    };

    return {
      handleAddToCart
    };
  }
};
</script>