<template>
  <div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold mb-8 text-gray-800">Checkout</h1>

      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Formulario de cliente -->
        <div class="flex-1 bg-white rounded-xl shadow-md p-6 flex flex-col gap-6">
          <h2 class="text-xl font-semibold text-gray-800">Datos del cliente</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" placeholder="Nombre completo" v-model="customer.name"
              class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition" />
            <input type="email" placeholder="Correo electrónico" v-model="customer.email"
              class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition" />
            <input type="text" placeholder="Teléfono" v-model="customer.phone"
              class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition" />
            <input type="text" placeholder="Dirección" v-model="customer.address"
              class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition" />
          </div>

          <!-- Método de pago -->
          <div class="mt-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Método de pago</h2>
            <div class="flex flex-col gap-2">
              <label class="flex items-center gap-2">
                <input type="radio" value="tarjeta" v-model="paymentMethod" class="accent-yellow-400">
                Tarjeta de crédito / débito
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" value="efectivo" v-model="paymentMethod" class="accent-yellow-400">
                Efectivo / Contra entrega
              </label>
            </div>
          </div>

          <UiButtons @click="confirmOrder"
            class="mt-6 bg-yellow-400 text-white py-3 rounded-lg font-semibold hover:brightness-105 transition">
            Confirmar compra
          </button>
        </div>

        <!-- Resumen del pedido -->
        <div class="w-full lg:w-1/3 bg-white rounded-xl shadow-md p-6 flex flex-col gap-4">
          <h2 class="text-xl font-semibold text-gray-800">Resumen del pedido</h2>
          <div v-for="(item, index) in cartItems" :key="index" class="flex justify-between items-center border-b border-gray-200 pb-2">
            <div>
              <p class="font-semibold text-gray-800">{{ item.name }} x{{ item.quantity }}</p>
              <p class="text-sm text-gray-500">Unitario: ${{ item.price }}</p>
            </div>
            <p class="font-semibold text-gray-800">${{ (item.price * item.quantity).toFixed(0) }}</p>
          </div>
          <div class="border-t border-gray-200 pt-2 flex justify-between text-gray-700">
            <span>Subtotal</span>
            <span>${{ subtotal.toFixed(0) }}</span>
          </div>
          <div class="flex justify-between text-gray-700">
            <span>Envío</span>
            <span>$2.000</span>
          </div>
          <div class="border-t border-gray-200 pt-2 flex justify-between font-bold text-gray-800 text-lg">
            <span>Total</span>
            <span>${{ total.toFixed(0) }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from "vue";

export default {
  name: "CheckoutPage",
  setup() {
    const customer = ref({
      name: "",
      email: "",
      phone: "",
      address: "",
    });

    const paymentMethod = ref("tarjeta");

    const cartItems = ref([
      { name: 'Almendras Premium', price: 5000, quantity: 2 },
      { name: 'Nueces Naturales', price: 4000, quantity: 1 },
      { name: 'Mix Frutos Secos', price: 7000, quantity: 3 },
    ]);

    const subtotal = computed(() => cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0));
    const shipping = 2000;
    const total = computed(() => subtotal.value + shipping);

    const confirmOrder = () => {
      if (!customer.value.name || !customer.value.email || !customer.value.address) {
        alert("Por favor completa todos los datos del cliente");
        return;
      }
      console.log("Orden confirmada:", {
        customer: customer.value,
        paymentMethod: paymentMethod.value,
        cartItems: cartItems.value,
        total: total.value
      });
      alert("¡Compra confirmada! Gracias por tu pedido 🥜");
    };

    return { customer, paymentMethod, cartItems, subtotal, total, confirmOrder };
  }
}
</script>

<style scoped>
/* Opcional: animaciones de hover y focus ya incluidas con Tailwind */
</style>
