<template>
  <a href="#" class="flex flex-col justify-center items-center h-36 rounded-full text-white text-center p-4 transition-transform duration-300 hover:scale-105" :class="bgClass">
    <div class="text-4xl mb-2">{{ emoji }}</div>
    <p class="font-semibold">{{ name }}</p>
  </a>
</template>

<script>
export default {
  props: {
    name: String,
    emoji: String,
    bgClass: String,
  },
};
</script>
