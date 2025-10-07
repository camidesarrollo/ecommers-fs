<template>
  <div class="min-h-screen bg-gray-50 py-6 sm:py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Título -->
      <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-gray-800">Productos</h1>

      <!-- Filtro por categoría - Desktop -->
      <div class="hidden md:flex flex-wrap gap-2 mb-8">
        <button v-for="cat in categoriasConTodos" :key="cat.id" @click="handleCategoryChange(cat.id)" :class="selectedCategory === cat.id
          ? 'bg-yellow-400 text-white'
          : 'bg-white text-gray-700 hover:bg-yellow-200'" class="px-4 py-2 rounded-full font-semibold transition">
          {{ cat.name }}
        </button>
      </div>

      <!-- Filtro por categoría - Mobile (Dropdown) -->
      <div class="md:hidden mb-6">
        <label for="category-select" class="block text-sm font-medium text-gray-700 mb-2">
          Filtrar por categoría
        </label>
        <select id="category-select" v-model="selectedCategory" @change="handleCategoryChange(selectedCategory)"
          class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 text-gray-700 font-medium">
          <option v-for="cat in categoriasConTodos" :key="cat.id" :value="cat.id">
            {{ cat.name }}
          </option>
        </select>
      </div>

      <!-- Contador de productos -->
      <div v-if="!loading" class="mb-4 text-sm text-gray-600">
        {{ productos.length }} {{ productos.length === 1 ? 'producto encontrado' : 'productos encontrados' }}
      </div>

      <!-- Loading state -->
      <div v-if="loading" class="flex justify-center items-center py-8">
        <div class="flex flex-col items-center gap-3">
          <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-yellow-400"></div>
          <div class="text-gray-600">Cargando productos...</div>
        </div>
      </div>

      <!-- Grid de productos -->
      <div v-else class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        <div v-for="producto in productos" :key="producto.product_variant_id"
          class="bg-white rounded-xl shadow-md p-3 sm:p-4 flex flex-col items-center hover:shadow-lg transition">
          <!-- Imagen / emoji placeholder -->
          <div class="w-24 h-24 sm:w-32 sm:h-32 bg-yellow-100 rounded-lg mb-3 sm:mb-4 flex items-center justify-center">
            <img v-if="producto.imagen" :src="`${producto.imagen}`" :alt="producto.name"
              class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg" />
            <span v-else class="text-3xl sm:text-4xl">🥜</span>
          </div>

          <!-- Nombre -->
          <RouterLink :to="`/Producto/${producto.product_variant_id}`">
            <p class="font-semibold text-gray-800 text-center mb-2 text-sm sm:text-base line-clamp-2">
              {{ producto.name }}
            </p>
          </RouterLink>

          <!-- Precio -->
          <p class="text-gray-600 mb-3 sm:mb-4 text-base sm:text-lg font-semibold">
            ${{ Number(producto.price).toLocaleString() }}
          </p>

          <!-- Botón agregar al carrito usando UiButtons -->
          <UiButtons tipo="agregar" :accion="() => addToCart(producto)" label="Agregar"
            class="w-full text-sm sm:text-base" icono="cart-plus" />
        </div>
      </div>

      <!-- Empty state -->
      <div v-if="!loading && productos.length === 0" class="text-center py-12">
        <div class="text-5xl mb-4">🔍</div>
        <p class="text-gray-600 text-lg mb-2">No se encontraron productos</p>
        <p class="text-gray-500 text-sm">Intenta con otra categoría</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, watch } from "vue";
import { useCategory } from "../../application/callbacks/category.cb";
import { useProduct, useProductSearch } from "../../application/callbacks/product.cb";
import type { ISearchProductRequest } from "../../domain/dtos/input/i.product.dto.input";

// --- Importa tu componente UiButtons ---
import UiButtons from "../components/Buttons/UiButtons.vue";

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
      await traerProduct();
    } else {
      const filtros: ISearchProductRequest = { category_id: Number(selectedCategory.value) };
      const { productos: filteredProducts, buscarProduct } = useProductSearch();
      await buscarProduct(filtros);
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
onMounted(async () => { await cargarProductos(); });

// --- Watchers ---
watch(categorias, () => {
  if (selectedCategory.value === "Todos") cargarProductos();
}, { deep: true });
</script>

<style scoped>
/* Utilidad para limitar líneas de texto */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>