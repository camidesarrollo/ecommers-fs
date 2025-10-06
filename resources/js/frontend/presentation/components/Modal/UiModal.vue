<template>
  <transition name="fade">
    <div
      v-if="show"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
      @click.self="close"
    >
      <div
        class="relative w-11/12 max-w-lg bg-beige rounded-2xl shadow-nut-brown/30 p-6 md:p-8 border border-nut-brown transform transition-all duration-300"
      >
        <!-- Header -->
        <div class="flex items-center gap-3 mb-4">
          <i v-if="icon" :class="icon" class="text-golden-yellow text-2xl"></i>
          <h2 class="text-lg md:text-xl font-semibold text-dark-chocolate">
            {{ title }}
          </h2>
        </div>

        <!-- Body -->
        <div class="text-gray-dark text-sm md:text-base space-y-3">
          <slot name="body">
            {{ message }}
          </slot>
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 mt-6">
          <button
            v-if="showCancel"
            class="px-4 py-2 rounded-lg font-semibold bg-gray-light text-dark-chocolate hover:bg-gray-light-dark transition"
            @click="close"
          >
            {{ cancelText }}
          </button>

          <button
            v-if="showConfirm"
            class="px-4 py-2 rounded-lg font-semibold bg-burgundy-red text-white hover:bg-burgundy-red-dark transition"
            @click="confirm"
          >
            {{ confirmText }}
          </button>
        </div>

        <!-- Cerrar con “X” -->
        <button
          class="absolute top-3 right-3 text-gray-dark hover:text-dark-chocolate transition"
          @click="close"
        >
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
  </transition>
</template>

<script setup>
const props = defineProps({
  show: { type: Boolean, required: true },
  title: { type: String, default: '' },
  message: { type: String, default: '' },
  icon: { type: String, default: 'fas fa-info-circle' },
  showCancel: { type: Boolean, default: true },
  showConfirm: { type: Boolean, default: true },
  cancelText: { type: String, default: 'Cancelar' },
  confirmText: { type: String, default: 'Confirmar' },
})
const emit = defineEmits(['close', 'confirm'])

function close() {
  emit('close')
}
function confirm() {
  emit('confirm')
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.25s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
