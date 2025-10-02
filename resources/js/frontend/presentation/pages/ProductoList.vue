<template>
  <div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Título -->
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Productos</h1>

      <!-- Filtro por categoría -->
      <div class="flex flex-wrap gap-2 mb-8">
        <button v-for="cat in categoriasConTodos" :key="cat.id" @click="handleCategoryChange(cat.id)" :class="selectedCategory === cat.id
          ? 'bg-yellow-400 text-white'
          : 'bg-white text-gray-700 hover:bg-yellow-200'" class="px-4 py-2 rounded-full font-semibold transition">
          {{ cat.name }}
        </button>
      </div>

      <!-- Loading state -->
      <div v-if="loading" class="flex justify-center items-center py-8">
        <div class="text-gray-600">Cargando productos...</div>
      </div>

      <!-- Grid de productos -->
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div v-for="producto in productos" :key="producto.id"
          class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center hover:shadow-lg transition">
          <!-- Imagen / emoji placeholder -->
          <div class="w-32 h-32 bg-yellow-100 rounded-lg mb-4 flex items-center justify-center">
            <img v-if="producto.images" :src="`/${producto.images}`" :alt="producto.name"
              class="w-32 h-32 object-cover rounded-lg" />
            <span v-else class="text-4xl">🥜</span>
          </div>

          <!-- Nombre -->
          <p class="font-semibold text-gray-800 text-center mb-2">{{ producto.name }}</p>

          <!-- Precio -->
          <p class="text-gray-600 mb-4">${{ Number(producto.price).toLocaleString() }}</p>

          <!-- Botón agregar al carrito -->
          <button @click="addToCart(producto)"
            class="bg-yellow-400 text-white px-4 py-2 rounded-lg font-semibold hover:brightness-105 transition">
            Agregar al carrito
          </button>
        </div>
      </div>

      <!-- Empty state -->
      <div v-if="!loading && productos.length === 0" class="text-center py-8">
        <p class="text-gray-600">No se encontraron productos.</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, watch } from "vue";
import { useCategory } from "../../application/callbacks/category.cb";
import { useProduct, useProductSearch } from "../../application/callbacks/product.cb";
import type { ISearchProductRequest } from "../../domain/dtos/input/i.product.dto.input";

// --- State management ---
const loading = ref(true);
const selectedCategory = ref<string | number>("Todos");

// --- Categorías ---
const { categorias } = useCategory();

const categoriasConTodos = computed(() => [
  { id: "Todos", name: "Todos" },
  ...categorias.value.map(c => ({ id: c.id, name: c.name }))
]);

// --- Productos (traer todos al inicio) ---
const { productos, traerProduct } = useProduct();

// --- Funciones ---
const cargarProductos = async () => {
  try {
    loading.value = true;

    if (selectedCategory.value === "Todos") {
      await traerProduct(); // ya maneja el async internamente
    } else {
      const filtros: ISearchProductRequest = {
        category_id: Number(selectedCategory.value)
      };
      const { productos: filteredProducts, buscarProduct } = useProductSearch();

      // Espera a que buscarProduct termine antes de copiar los productos
      await buscarProduct(filtros);

      // Ahora sí tiene los datos
      productos.value = filteredProducts.value;
    }

  } catch (error) {
    console.error("Error al cargar productos:", error);
    productos.value = [];
  } finally {
    loading.value = false;
  }
};

const handleCategoryChange = async (category_id: string | number) => {
  selectedCategory.value = category_id;
  await cargarProductos();
};

const addToCart = (producto: { name: string }) => {
  alert(`Agregado al carrito: ${producto.name}`);
};

// --- Lifecycle ---
onMounted(async () => {
  await cargarProductos();
});

// --- Watchers ---
watch(categorias, () => {
  if (selectedCategory.value === "Todos") {
    cargarProductos();
  }
}, { deep: true });
</script>
