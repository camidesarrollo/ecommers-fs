<template>
  <button
    :class="[
      'px-4 py-2 rounded-full font-semibold shadow transition-transform duration-300',
      type === 'primary' ? 'bg-gradient-to-r from-red-500 to-orange-400 text-white hover:from-red-600 hover:to-orange-500 hover:scale-105' : '',
      type === 'success' ? 'bg-gradient-to-r from-green-400 to-green-600 text-white hover:from-green-500 hover:to-green-700 hover:scale-105' : '',
      type === 'purple' ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white hover:from-purple-600 hover:to-pink-600 hover:scale-105' : '',
      type === 'blue' ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white hover:from-blue-600 hover:to-purple-600 hover:scale-105' : '',
      type === 'light' ? 'bg-white text-blue-500 hover:bg-gray-100' : ''
    ]"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    type: { type: String, default: 'primary' },
  },
};
</script>
