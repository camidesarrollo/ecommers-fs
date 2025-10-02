<template>
  <!-- Si no tiene layout o es 'none', renderiza directamente la vista -->
  <router-view v-if="!currentLayout || currentLayout === 'none'" />
  
  <!-- Si tiene layout, usa el componente correspondiente -->
  <component v-else :is="currentLayout">
    <router-view />
  </component>
</template>

<script>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import PublicLayout from './layouts/PublicLayout.vue'
import AdminLayout from './layouts/AdminLayout.vue' // Si tienes un layout de admin

export default {
  name: 'App',
  components: {
    PublicLayout,
    AdminLayout
  },
  setup() {
    const route = useRoute()

    const currentLayout = computed(() => {
      const layoutName = route.meta.layout

      switch (layoutName) {
        case 'public':
          return PublicLayout
        case 'admin':
          return AdminLayout
        case 'none':
        default:
          return null
      }
    })

    return {
      currentLayout
    }
  }
}
</script>
