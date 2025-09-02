<template>
  <div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Título -->
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Productos</h1>

      <!-- Filtro por categoría -->
      <div class="flex flex-wrap gap-2 mb-8">
        <button 
          v-for="cat in categorias" 
          :key="cat" 
          @click="selectedCategory = cat"
          :class="selectedCategory === cat ? 'bg-yellow-400 text-white' : 'bg-white text-gray-700 hover:bg-yellow-200'"
          class="px-4 py-2 rounded-full font-semibold transition"
        >
          {{ cat }}
        </button>
      </div>

      <!-- Grid de productos -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div 
          v-for="producto in filteredProducts" 
          :key="producto.id"
          class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center hover:shadow-lg transition"
        >
          <!-- Imagen / emoji placeholder -->
          <div class="w-32 h-32 bg-yellow-100 rounded-lg mb-4 flex items-center justify-center text-4xl">
            🥜
          </div>

          <!-- Nombre -->
          <p class="font-semibold text-gray-800 text-center mb-2">{{ producto.name }}</p>

          <!-- Precio -->
          <p class="text-gray-600 mb-4">${{ producto.price.toLocaleString() }}</p>

          <!-- Botón agregar al carrito -->
          <button @click="addToCart(producto)"
                  class="bg-yellow-400 text-white px-4 py-2 rounded-lg font-semibold hover:brightness-105 transition">
            Agregar al carrito
          </button>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

// Lista de productos (ejemplo)
const productos = ref([
  { id: 1, name: "Almendras Premium", price: 5000, category: "Frutos Secos" },
  { id: 2, name: "Mix de Nueces", price: 7000, category: "Frutos Secos" },
  { id: 3, name: "Pistachos Naturales", price: 6000, category: "Frutos Secos" },
  { id: 4, name: "Dátiles sin hueso", price: 4500, category: "Frutas Deshidratadas" },
  { id: 5, name: "Cranberry con chocolate", price: 5500, category: "Frutas Deshidratadas" },
  { id: 6, name: "Aceituna Rellena", price: 3500, category: "Aceitunas y Olivas" },
  { id: 7, name: "Chocolate Amargo", price: 8000, category: "Chocolates y Dulces" },
  // Agrega más productos según necesites
]);

// Categorías únicas
const categorias = ref(["Todos", ...new Set(productos.value.map(p => p.category))]);

// Filtro
const selectedCategory = ref("Todos");
const filteredProducts = computed(() => {
  if (selectedCategory.value === "Todos") return productos.value;
  return productos.value.filter(p => p.category === selectedCategory.value);
});

// Función agregar al carrito
const addToCart = (producto) => {
  alert(`Agregado al carrito: ${producto.name}`);
};
</script>

<style scoped>
/* Hover y transición ya incluidas en Tailwind */
</style>
