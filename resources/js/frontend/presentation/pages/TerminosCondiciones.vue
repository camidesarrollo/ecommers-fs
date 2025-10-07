<template>
  <div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Tabs de navegación -->
      <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex flex-wrap gap-2">
        <button
          v-for="tab in tabs" :key="tab"
          @click="activeTab = tab"
          :class="activeTab === tab 
            ? 'bg-yellow-400 text-white' 
            : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
          class="px-4 py-2 rounded-lg font-medium transition">
          {{ tab }}
        </button>
      </div>

      <!-- Contenido de tabs -->
      <div class="bg-white rounded-xl shadow-md p-6">
        <!-- Términos y Condiciones -->
        <div v-if="activeTab === 'Términos y Condiciones'" class="space-y-4">
            
        </div>

        <!-- Politicas de Cambios -->
        <div v-if="activeTab === 'Politicas de Cambios'" class="space-y-4">
          
        </div>

        <!-- Politica de Privacidad -->
        <div v-if="activeTab === 'Historial de Compras'" class="space-y-4">
          
        </div>

        <!-- Pago Seguro -->
        <div v-if="activeTab === 'Favoritos'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          
        </div>

        <!-- Politica de Cookies -->
        <div v-if="activeTab === 'Politica de Cookies'" class="space-y-4">
          
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import { ref, reactive } from 'vue';

export default {
  name: "TerminosCondiciones",
  setup() {
    const tabs = ['Términos y Condiciones', 'Politicas de Cambios', 'Historial de Compras', 'Favoritos', 'Métodos de Pago', 'Email Preferences'];
    const activeTab = ref('Términos y Condiciones');

    return { tabs, activeTab };
  }
}
</script>

<style scoped>
/* Puedes agregar animaciones suaves de transición de tabs si quieres */
</style>
