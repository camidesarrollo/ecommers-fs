<template>
  <div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Mis Favoritos</h1>

      <div v-if="favorites.length === 0" class="text-center text-gray-500 py-20">
        <p>No tienes productos favoritos aún.</p>
      </div>

      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="(producto, index) in favorites" :key="producto.id"
             class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center hover:shadow-lg transition">
          
          <!-- Imagen / Emoji como placeholder -->
          <div class="w-32 h-32 bg-yellow-100 rounded-lg mb-4 flex items-center justify-center text-4xl">
            🥜
          </div>

          <!-- Nombre -->
          <p class="font-semibold text-gray-800 text-center mb-2">{{ producto.name }}</p>
          
          <!-- Precio -->
          <p class="text-gray-600 mb-4">${{ producto.price.toLocaleString() }}</p>

          <!-- Botones -->
          <div class="flex gap-2">
            <button @click="addToCart(producto)"
                    class="bg-yellow-400 text-white px-4 py-2 rounded-lg font-semibold hover:brightness-105 transition">
              Agregar al carrito
            </button>
            <button @click="removeFromFavorites(index)"
                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
              Quitar
            </button>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";

export default {
  name: "FavoritesPage",
  setup() {
    // Lista de productos favoritos (ejemplo)
    const favorites = ref([
      { id: 1, name: "Almendras Premium", price: 5000 },
      { id: 2, name: "Mix de Nueces", price: 7000 },
      { id: 3, name: "Pistachos Naturales", price: 6000 },
    ]);

    const addToCart = (producto) => {
      console.log("Agregando al carrito:", producto);
      alert(`Agregado al carrito: ${producto.name}`);
    };

    const removeFromFavorites = (index) => {
      favorites.value.splice(index, 1);
    };

    return { favorites, addToCart, removeFromFavorites };
  }
}
</script>

<style scoped>
/* Hover y transiciones ya incluidas con Tailwind */
</style>
