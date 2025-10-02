<template>
  <span
    :class="[
      'inline-flex items-center justify-center rounded-full font-semibold transition-all duration-300',
      sizeClasses,
      variantClasses,
      { 'animate-pulse-slow': pulse }
    ]"
  >
    <slot />
  </span>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  variant: {
    type: String,
    default: 'primary',
    validator: (value) => [
      'primary',
      'secondary',
      'success',
      'warning',
      'error',
      'olive',
      'nut',
      'golden',
      'burgundy',
      'mint',
      'orange'
    ].includes(value)
  },
  size: {
    type: String,
    default: 'md',
    validator: (value) => ['xs', 'sm', 'md', 'lg'].includes(value)
  },
  pulse: {
    type: Boolean,
    default: false
  }
});

const sizeClasses = computed(() => {
  const sizes = {
    xs: 'px-2 py-0.5 text-xs',
    sm: 'px-2.5 py-1 text-sm',
    md: 'px-3 py-1.5 text-sm',
    lg: 'px-4 py-2 text-base'
  };
  return sizes[props.size];
});

const variantClasses = computed(() => {
  const variants = {
    primary: 'bg-beige text-primary border border-nut-brown',
    secondary: 'bg-gray-light text-gray-dark',
    success: 'bg-olive-green text-white',
    warning: 'bg-orange-warm text-white',
    error: 'bg-burgundy-red text-white',
    olive: 'bg-olive-green text-white shadow-olive-green/30',
    nut: 'bg-nut-brown text-white shadow-nut-brown/30',
    golden: 'bg-golden-yellow text-dark-chocolate shadow-golden-yellow/30',
    burgundy: 'bg-burgundy-red text-white shadow-burgundy-red/30',
    mint: 'bg-mint-green text-dark-chocolate shadow-mint-green/30',
    orange: 'bg-orange-warm text-white shadow-orange-warm/30'
  };
  return variants[props.variant];
});
</script>

<style scoped>
.animate-pulse-slow {
  animation: pulse 3s infinite;
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.7;
  }
}
</style>