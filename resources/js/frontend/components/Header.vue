<template>
  <header class="sticky top-0 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center p-4">
      
      <!-- Logo -->
      <div class="flex items-center gap-3">
        <div class="rounded-full p-2 bg-gradient-to-br from-yellow-700 to-yellow-500 text-white text-xl animate-bounce">
          🥜
        </div>
        <span class="font-bold text-xl text-gray-800">NutsMart</span>
      </div>

      <!-- Botones de acción -->
      <div class="flex items-center gap-3">
        <!-- Buscar -->
        <button class="text-gray-700 text-2xl">
          <font-awesome-icon :icon="['fas','search']" />
        </button>

        <!-- Carrito -->
        <button class="relative text-gray-700 text-2xl">
          <font-awesome-icon :icon="['fas','shopping-cart']" />
          <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 animate-pulse">
            3
          </span>
        </button>
      </div>

    </div>
  </header>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faSearch, faShoppingCart } from '@fortawesome/free-solid-svg-icons'

// Registrar íconos en la librería
library.add(faSearch, faShoppingCart)

export default {
  name: "Header",
  components: {
    FontAwesomeIcon
  }
}
</script>

<style scoped>
/* Animaciones o estilos extra si quieres */
</style>
