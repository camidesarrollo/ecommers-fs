<template>
  <div
    :class="[
      'inline-flex',
      orientationClasses,
      sizeClasses,
      { 'shadow-lg': elevated }
    ]"
    role="group"
  >
    <slot />
  </div>
</template>

<script setup>
import { computed, provide } from 'vue';

const props = defineProps({
  orientation: {
    type: String,
    default: 'horizontal',
    validator: (value) => ['horizontal', 'vertical'].includes(value)
  },
  size: {
    type: String,
    default: 'md',
    validator: (value) => ['xs', 'sm', 'md', 'lg'].includes(value)
  },
  variant: {
    type: String,
    default: 'olive',
    validator: (value) => [
      'olive',
      'nut',
      'golden',
      'burgundy',
      'mint',
      'orange',
      'primary',
      'secondary'
    ].includes(value)
  },
  elevated: {
    type: Boolean,
    default: false
  },
  fullWidth: {
    type: Boolean,
    default: false
  }
});

const orientationClasses = computed(() => {
  if (props.orientation === 'vertical') {
    return 'flex-col';
  }
  return props.fullWidth ? 'flex w-full' : 'flex-row';
});

const sizeClasses = computed(() => {
  const sizes = {
    xs: 'gap-0',
    sm: 'gap-0',
    md: 'gap-0',
    lg: 'gap-0'
  };
  return sizes[props.size];
});

// Provide context to child buttons
provide('buttonGroup', {
  size: props.size,
  variant: props.variant,
  orientation: props.orientation,
  fullWidth: props.fullWidth
});
</script>

<style scoped>
/* Rounded corners only on first and last buttons */
:deep(button:first-child),
:deep(a:first-child) {
  border-top-left-radius: 0.5rem;
  border-bottom-left-radius: 0.5rem;
}

:deep(button:last-child),
:deep(a:last-child) {
  border-top-right-radius: 0.5rem;
  border-bottom-right-radius: 0.5rem;
}

:deep(button:not(:first-child):not(:last-child)),
:deep(a:not(:first-child):not(:last-child)) {
  border-radius: 0;
}

/* Vertical orientation */
.flex-col :deep(button:first-child),
.flex-col :deep(a:first-child) {
  border-top-left-radius: 0.5rem;
  border-top-right-radius: 0.5rem;
  border-bottom-left-radius: 0;
}

.flex-col :deep(button:last-child),
.flex-col :deep(a:last-child) {
  border-bottom-left-radius: 0.5rem;
  border-bottom-right-radius: 0.5rem;
  border-top-right-radius: 0;
}

/* Remove borders between buttons */
:deep(button:not(:last-child)),
:deep(a:not(:last-child)) {
  border-right: 1px solid rgba(255, 255, 255, 0.2);
}

.flex-col :deep(button:not(:last-child)),
.flex-col :deep(a:not(:last-child)) {
  border-right: none;
  border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

/* Full width buttons */
.w-full :deep(button),
.w-full :deep(a) {
  flex: 1;
}
</style>