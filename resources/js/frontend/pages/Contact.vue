<template>
  <div class="min-h-screen bg-gradient-to-br from-yellow-50 to-yellow-100 text-gray-800">
    <!-- Hero -->
    <section class="bg-gradient-to-r from-yellow-400 to-pink-400 text-white py-20 text-center relative overflow-hidden">
      <h1 class="text-5xl md:text-6xl font-extrabold mb-4">Contáctanos</h1>
      <p class="text-xl md:text-2xl opacity-90 max-w-2xl mx-auto">
        Estamos aquí para ayudarte. Escríbenos tus dudas, sugerencias o pedidos especiales.
      </p>
      <!-- Emoji flotante -->
      <div class="absolute inset-0 opacity-20">
        <div class="absolute animate-bounce" style="top:20%; left:10%; font-size:4rem;">🌰</div>
        <div class="absolute animate-bounce delay-200" style="top:50%; right:15%; font-size:5rem;">🥜</div>
      </div>
    </section>

    <!-- Formulario y contacto -->
    <section class="py-16">
      <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-12">
        <!-- Formulario de contacto -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
          <h2 class="text-3xl font-bold mb-6">Envíanos un mensaje</h2>
          <form @submit.prevent="submitForm" class="space-y-4">
            <div>
              <label class="block text-sm font-semibold mb-1">Nombre</label>
              <input v-model="form.name" type="text" placeholder="Tu nombre"
                     class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none" />
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Correo electrónico</label>
              <input v-model="form.email" type="email" placeholder="ejemplo@correo.com"
                     class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none" />
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Mensaje</label>
              <textarea v-model="form.message" rows="5" placeholder="Escribe tu mensaje..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none"></textarea>
            </div>
            <button type="submit"
                    class="bg-gradient-to-r from-pink-500 to-yellow-400 text-white font-bold px-6 py-3 rounded-full shadow-lg hover:brightness-110 transition">
              Enviar
            </button>
          </form>
          <div v-if="successMessage" class="mt-4 text-green-600 font-semibold">
            {{ successMessage }}
          </div>
        </div>

        <!-- Información de contacto -->
        <div class="space-y-6">
          <div class="p-6 bg-yellow-100 rounded-2xl shadow-md flex items-center gap-4">
            <div class="text-3xl">📞</div>
            <div>
              <h4 class="font-bold text-lg">Teléfono</h4>
              <p>+56 9 5110 8675</p>
            </div>
          </div>
          <div class="p-6 bg-pink-100 rounded-2xl shadow-md flex items-center gap-4">
            <div class="text-3xl">📧</div>
            <div>
              <h4 class="font-bold text-lg">Correo</h4>
              <p>comercializadora@nuts.cl</p>
            </div>
          </div>
          <div class="p-6 bg-green-100 rounded-2xl shadow-md flex items-center gap-4">
            <div class="text-3xl">📍</div>
            <div>
              <h4 class="font-bold text-lg">Dirección</h4>
              <p>Av Grecia 2929 - Ñuñoa, Santiago, Chile</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-yellow-400 to-pink-400 text-center text-white">
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Listo para probar nuestros frutos secos?</h2>
      <router-link to="/" 
        class="bg-white text-yellow-600 font-bold px-8 py-3 rounded-full shadow-md hover:brightness-105 transition">
        Explorar Productos
      </router-link>
    </section>
  </div>
</template>

<script setup>
import { ref } from "vue";

const form = ref({
  name: '',
  email: '',
  message: ''
});

const successMessage = ref('');

const submitForm = () => {
  // Aquí podrías integrar API real
  console.log('Mensaje enviado', form.value);
  successMessage.value = "¡Gracias! Tu mensaje ha sido enviado.";
  // Limpiar formulario
  form.value.name = '';
  form.value.email = '';
  form.value.message = '';
};
</script>

<style scoped>
.animate-bounce {
  animation: bounce 3s infinite;
}
.animate-bounce.delay-200 {
  animation-delay: 0.2s;
}
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-15px); }
}
</style>
