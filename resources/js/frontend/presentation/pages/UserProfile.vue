<template>
  <div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Header de perfil -->
      <div class="flex items-center gap-4 mb-8">
        <div class="w-20 h-20 rounded-full bg-yellow-400 flex items-center justify-center text-white text-2xl font-bold">
          🥜
        </div>
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Mi Perfil</h1>
          <p class="text-gray-500">Bienvenido de nuevo, <span class="font-semibold">Juan Pérez</span></p>
        </div>
      </div>

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
        <!-- Información Personal -->
        <div v-if="activeTab === 'Información Personal'" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" placeholder="Nombre completo" class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition" />
            <input type="email" placeholder="Correo electrónico" class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition" />
            <input type="text" placeholder="Teléfono" class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition" />
          </div>
          <button class="bg-yellow-400 text-white px-6 py-2 rounded-lg font-semibold hover:brightness-105 transition">
            Actualizar información
          </button>
        </div>

        <!-- Direcciones -->
        <div v-if="activeTab === 'Direcciones'" class="space-y-4">
          <div v-for="(direccion, index) in 3" :key="index" class="flex justify-between items-center p-4 border border-gray-200 rounded-lg">
            <div>
              <p class="font-semibold">Casa Principal</p>
              <p class="text-gray-500 text-sm">Av. Grecia 2929, Ñuñoa, Santiago</p>
            </div>
            <div class="flex gap-2">
              <button class="text-blue-500 hover:underline text-sm">Editar</button>
              <button class="text-red-500 hover:underline text-sm">Eliminar</button>
            </div>
          </div>
          <button class="bg-green-400 text-white px-6 py-2 rounded-lg font-semibold hover:brightness-105 transition">
            Agregar dirección
          </button>
        </div>

        <!-- Historial de compras -->
        <div v-if="activeTab === 'Historial de Compras'" class="space-y-4">
          <div v-for="(pedido, index) in 3" :key="index" class="flex justify-between items-center p-4 border border-gray-200 rounded-lg">
            <div>
              <p class="font-semibold">Pedido #12345</p>
              <p class="text-gray-500 text-sm">3 productos - 05/08/2025</p>
            </div>
            <div class="flex gap-2">
              <button class="bg-yellow-400 text-white px-4 py-1 rounded-lg text-sm hover:brightness-105 transition">Ver detalles</button>
              <button class="bg-gray-100 text-gray-700 px-4 py-1 rounded-lg text-sm hover:bg-gray-200 transition">Repetir pedido</button>
            </div>
          </div>
        </div>

        <!-- Wishlist / Favoritos -->
        <div v-if="activeTab === 'Favoritos'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <div v-for="(producto, index) in 6" :key="index" class="bg-gray-50 rounded-lg p-4 flex flex-col items-center shadow-sm hover:shadow-md transition">
            <div class="w-24 h-24 bg-yellow-100 rounded-lg mb-2 flex items-center justify-center text-2xl">🥜</div>
            <p class="font-semibold text-gray-800">Producto Favorito</p>
            <button class="mt-2 bg-yellow-400 text-white px-4 py-1 rounded-lg hover:brightness-105 transition text-sm">
              Agregar al carrito
            </button>
          </div>
        </div>

        <!-- Métodos de pago -->
        <div v-if="activeTab === 'Métodos de Pago'" class="space-y-4">
          <div v-for="(tarjeta, index) in 3" :key="index" class="flex justify-between items-center p-4 border border-gray-200 rounded-lg">
            <div>
              <p class="font-semibold">Visa **** 1234</p>
              <p class="text-gray-500 text-sm">Expira 12/25</p>
            </div>
            <div class="flex gap-2">
              <button class="text-blue-500 hover:underline text-sm">Editar</button>
              <button class="text-red-500 hover:underline text-sm">Eliminar</button>
            </div>
          </div>
          <button class="bg-green-400 text-white px-6 py-2 rounded-lg font-semibold hover:brightness-105 transition">
            Agregar método de pago
          </button>
        </div>

        <!-- Email Preferences -->
        <div v-if="activeTab === 'Email Preferences'" class="space-y-4">
          <h2 class="text-xl font-semibold text-gray-800">Preferencias de Email</h2>
          <p class="text-gray-500">Selecciona los tipos de notificaciones que deseas recibir:</p>
          <div class="space-y-2">
            <label class="flex items-center gap-2">
              <input type="checkbox" class="form-checkbox h-5 w-5 text-yellow-400" v-model="preferences.promociones" />
              Promociones y ofertas
            </label>
            <label class="flex items-center gap-2">
              <input type="checkbox" class="form-checkbox h-5 w-5 text-yellow-400" v-model="preferences.novedades" />
              Novedades del sitio
            </label>
            <label class="flex items-center gap-2">
              <input type="checkbox" class="form-checkbox h-5 w-5 text-yellow-400" v-model="preferences.historial" />
              Resumen de historial de compras
            </label>
          </div>
          <button class="bg-yellow-400 text-white px-6 py-2 rounded-lg font-semibold hover:brightness-105 transition" @click="savePreferences">
            Guardar preferencias
          </button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import { ref, reactive } from 'vue';

export default {
  name: "UserProfile",
  setup() {
    const tabs = ['Información Personal', 'Direcciones', 'Historial de Compras', 'Favoritos', 'Métodos de Pago', 'Email Preferences'];
    const activeTab = ref('Información Personal');

    const preferences = reactive({
      promociones: true,
      novedades: false,
      historial: true
    });

    const savePreferences = () => {
      console.log("Preferencias guardadas:", preferences);
      alert("Preferencias guardadas correctamente");
    };

    return { tabs, activeTab, preferences, savePreferences };
  }
}
</script>

<style scoped>
/* Puedes agregar animaciones suaves de transición de tabs si quieres */
</style>
