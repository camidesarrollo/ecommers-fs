<template>
  <component :is="layout">
    <router-view />
  </component>
</template>

<script>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import PublicLayout from './layouts/PublicLayout.vue';
// Puedes agregar más layouts en el futuro, como AdminLayout

export default {
  setup() {
    const route = useRoute();

    const layout = computed(() => {
      // Por defecto usamos PublicLayout
      switch (route.meta.layout) {
        case 'public':
        default:
          return PublicLayout;
      }
    });

    return { layout };
  },
};
</script>
