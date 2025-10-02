<template>
  <div class="relative p-8 rounded-2xl text-white text-center overflow-hidden" :class="bgClass">
    <h3 class="text-2xl font-bold mb-3">{{ title }}</h3>
    <p class="text-lg mb-4">{{ subtitle }}</p>
    <UiButtons :label="buttonText" tipo="light" :accion="() => $emit('onClick')" />

    <span class="absolute top-5 left-8 text-3xl animate-bounce">🎁</span>
    <span class="absolute bottom-5 right-8 text-xl animate-bounce animate-delay-500">✨</span>
  </div>
</template>

<script>
import UiButtons from './Buttons/UiButtons.vue';

export default {
  components: { UiButtons },
  props: {
    title: String,
    subtitle: String,
    buttonText: String,
    bgClass: { type: String, default: 'bg-gradient-to-r from-pink-500 to-orange-500' },
  },
  emits: ['onClick']
};
</script>
