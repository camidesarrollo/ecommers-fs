<template>
  <transition name="fade">
    <div v-if="loading" class="fixed inset-0 flex flex-col justify-center items-center bg-gray-light/70 z-50">
      <div class="spinner border-t-4 border-r-4 border-olive-green rounded-full w-16 h-16 animate-spin"></div>
      <p class="mt-4 text-dark-chocolate font-semibold">{{ message }}</p>
    </div>
  </transition>
</template>

<script setup>
defineProps({
  loading: { type: Boolean, required: true },
  message: { type: String, default: 'Cargando...' }
});
</script>

<style scoped>
.spinner {
  border-top-color: var(--color-olive-green-dark);
  border-right-color: transparent;
  border-bottom-color: transparent;
  border-left-color: transparent;
}
</style>
