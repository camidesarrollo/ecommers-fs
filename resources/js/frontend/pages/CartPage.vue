<template>
  <div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold mb-8 text-gray-800">Tu Carrito de Compra</h1>

      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Lista de productos -->
        <div class="flex-1 bg-white rounded-xl shadow-md p-6">
          <div v-if="cartItems.length === 0" class="text-center py-12 text-gray-500">
            Tu carrito está vacío 😔
          </div>
          <div v-else class="flex flex-col gap-4">
            <div v-for="(item, index) in cartItems" :key="index" class="flex items-center justify-between gap-4 border-b border-gray-200 pb-4">
              <img :src="item.image" alt="Producto" class="w-20 h-20 object-cover rounded-lg">
              <div class="flex-1">
                <p class="font-semibold text-gray-800">{{ item.name }}</p>
                <p class="text-sm text-gray-500">Precio unitario: ${{ item.price }}</p>
                <div class="flex items-center mt-2 gap-2">
                  <button @click="decreaseQuantity(index)" class="bg-gray-200 px-2 rounded hover:bg-gray-300 transition">-</button>
                  <span>{{ item.quantity }}</span>
                  <button @click="increaseQuantity(index)" class="bg-gray-200 px-2 rounded hover:bg-gray-300 transition">+</button>
                  <button @click="removeItem(index)" class="ml-4 text-red-500 hover:text-red-700 transition text-sm">Eliminar</button>
                </div>
              </div>
              <p class="font-semibold text-gray-800">${{ (item.price * item.quantity).toFixed(0) }}</p>
            </div>
          </div>
        </div>

        <!-- Resumen del carrito -->
        <div class="w-full lg:w-1/3 bg-white rounded-xl shadow-md p-6 flex flex-col gap-4">
          <h2 class="text-xl font-semibold text-gray-800">Resumen del pedido</h2>
          <div class="flex justify-between text-gray-700">
            <span>Subtotal</span>
            <span>${{ subtotal.toFixed(0) }}</span>
          </div>
          <div class="flex justify-between text-gray-700">
            <span>Envío</span>
            <span>$2.000</span>
          </div>
          <div class="border-t border-gray-200"></div>
          <div class="flex justify-between font-bold text-gray-800 text-lg">
            <span>Total</span>
            <span>${{ total.toFixed(0) }}</span>
          </div>
          <button class="bg-yellow-400 text-white py-3 rounded-lg font-semibold hover:brightness-105 transition mt-4">
            Proceder al pago
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from "vue";

export default {
  name: "CartPage",
  setup() {
    const cartItems = ref([
      { name: 'Almendras Premium', price: 5000, quantity: 2, image: 'https://images.unsplash.com/photo-1611078481039-0e118f2e503f?auto=format&fit=crop&w=64&q=80' },
      { name: 'Nueces Naturales', price: 4000, quantity: 1, image: 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?auto=format&fit=crop&w=64&q=80' },
      { name: 'Mix Frutos Secos', price: 7000, quantity: 3, image: 'https://images.unsplash.com/photo-1612392061780-fc2b3c0c5a36?auto=format&fit=crop&w=64&q=80' },
    ]);

    const increaseQuantity = (index) => {
      cartItems.value[index].quantity++;
    };
    const decreaseQuantity = (index) => {
      if (cartItems.value[index].quantity > 1) {
        cartItems.value[index].quantity--;
      }
    };
    const removeItem = (index) => {
      cartItems.value.splice(index, 1);
    };

    const subtotal = computed(() => cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0));
    const shipping = 2000;
    const total = computed(() => subtotal.value + shipping);

    return { cartItems, increaseQuantity, decreaseQuantity, removeItem, subtotal, total };
  }
}
</script>

<style scoped>
/* Opcional: animación suave al modificar cantidad */
button {
  transition: all 0.2s ease;
}
</style>
