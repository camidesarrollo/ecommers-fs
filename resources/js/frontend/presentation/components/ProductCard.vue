<template>
  <div class="relative rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
    <span v-if="discount" class="absolute top-4 left-4 bg-red-500 text-white font-bold px-2 py-1 rounded-lg animate-pulse">-{{ discount }}%</span>
    
    <div :class="['h-48 flex items-center justify-center text-5xl', bgClass]">
      <div class="animate-pulse-slow">{{ emoji }}</div>
    </div>

    <div class="p-4">
      <h5 class="font-bold text-lg text-gray-800">{{ title }}</h5>
      <p class="text-sm text-gray-500 mb-3">{{ subtitle }}</p>
      <div class="flex justify-between items-center">
        <div>
          <span class="text-green-600 font-bold text-lg">${{ price }}</span>
          <span v-if="oldPrice" class="text-gray-400 line-through ml-2">${{ oldPrice }}</span>
        </div>
        <Button :type="buttonType" @click="$emit('add')">{{ buttonText }}</Button>
      </div>
    </div>
  </div>
</template>

<script>
import Button from './Button.vue';

export default {
  components: { Button },
  props: {
    title: String,
    subtitle: String,
    price: Number,
    oldPrice: Number,
    discount: Number,
    emoji: String,
    bgClass: String,
    buttonText: { type: String, default: 'Agregar' },
    buttonType: { type: String, default: 'success' },
  },
};
</script>
