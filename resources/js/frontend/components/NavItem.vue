<template>
  <a href="#" @click.prevent="$emit('click')" 
     class="flex flex-col items-center p-2 text-gray-500 hover:text-blue-500 transition-colors" 
     :class="active ? 'text-blue-500' : ''">
    <font-awesome-icon :icon="icon" class="text-2xl mb-1"/>
    <small>{{ label }}</small>
  </a>
</template>

<script>
export default {
  name: "NavItem",
  props: {
    icon: {
      type: Array, // <-- Cambiado a Array
      required: true
    },
    label: {
      type: String,
      required: true
    },
    active: {
      type: Boolean,
      default: false
    }
  }
};
</script>

<style scoped>
a:active {
  transform: scale(0.95);
}
</style>
