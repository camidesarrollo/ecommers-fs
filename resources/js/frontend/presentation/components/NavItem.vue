<template>
  <router-link :to="to" class="flex flex-col items-center p-2 transition-colors"
               :class="active ? 'text-blue-500' : 'text-gray-500 hover:text-blue-500'"
               @click.native="emitActive">
    <font-awesome-icon :icon="['fas', icon]" class="text-2xl mb-1"/>
    <small>{{ label }}</small>
  </router-link>
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
    },
    to: { type: String, required: true }
  },
  methods: {
    emitActive() {
      this.$emit('update:active', this.label.toLowerCase());
    }
  }
};
</script>

<style scoped>
a:active {
  transform: scale(0.95);
}
</style>
