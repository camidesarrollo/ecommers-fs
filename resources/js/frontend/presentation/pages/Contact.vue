<template>
  <div class="min-h-screen bg-gradient-to-br from-yellow-50 to-yellow-100 text-gray-800">
    <!-- Hero -->
    <section class="bg-gradient-to-r from-yellow-400 to-pink-400 text-white py-20 text-center relative overflow-hidden">
      <h1 class="text-5xl md:text-6xl font-extrabold mb-4">Contáctanos</h1>
      <p class="text-xl md:text-2xl opacity-90 max-w-2xl mx-auto">
        Estamos aquí para ayudarte. Escríbenos tus dudas, sugerencias o pedidos especiales.
      </p>
      <div class="absolute inset-0 opacity-20">
        <div class="absolute animate-bounce" style="top:20%; left:10%; font-size:4rem;">🌰</div>
        <div class="absolute animate-bounce delay-200" style="top:50%; right:15%; font-size:5rem;">🥜</div>
      </div>
    </section>

    <!-- Formulario -->
    <section class="py-16">
      <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-12">
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

            <!-- 🔹 Reemplazo del botón por UiButtons -->
            <UiButtons
              tipo="agregar"
              :accion="submitForm"
              :loading="loading"
              :isFormValid="isFormValid"
              label="Enviar Mensaje"
              icono="paper-plane"
              iconFamily="fas"
              loadingText="Enviando..."
            />
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

          <div class="p-6 bg-green-100 rounded-2xl shadow-md">
            <div class="flex items-center gap-4 mb-4">
              <div class="text-3xl">📍</div>
              <div>
                <h4 class="font-bold text-lg">Dirección</h4>
                <p>Av Grecia 2929 - Ñuñoa, Santiago, Chile</p>
              </div>
            </div>
            <div class="flex gap-3 mb-4">
              <a href="https://goo.gl/maps/xxxxxxx" target="_blank"
                 class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-medium hover:bg-red-200 transition">
                Google Maps
              </a>
              <a href="https://waze.com/ul?ll=-33.445,-70.622&navigate=yes" target="_blank"
                 class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                Waze
              </a>
            </div>
            <div class="w-full h-64 rounded-lg overflow-hidden shadow-inner">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.8419620522887!2d-70.63446!3d-33.425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDI1JzMwLjAiUyA3MMKwMzgnMDQuMSJX!5e0!3m2!1ses!2scl!4v1234567890"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-yellow-400 to-pink-400 text-center text-white">
      <h2 class="text-3xl md:text-4xl font-bold mb-6">¿Listo para probar nuestros frutos secos?</h2>
      <router-link to="/" class="bg-white text-yellow-600 font-bold px-8 py-3 rounded-full shadow-md hover:brightness-105 transition">
        Explorar Productos
      </router-link>
    </section>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import UiButtons from '../components/Buttons/UiButtons.vue' // Ajusta la ruta según tu estructura

const form = ref({ name: '', email: '', message: '' })
const successMessage = ref('')
const loading = ref(false)

const isFormValid = computed(() =>
  form.value.name.trim() !== '' &&
  form.value.email.trim() !== '' &&
  form.value.message.trim() !== ''
)

const submitForm = async () => {
  if (!isFormValid.value) return
  loading.value = true
  try {
    await new Promise(resolve => setTimeout(resolve, 1500)) // Simula envío
    successMessage.value = '¡Gracias! Tu mensaje ha sido enviado.'
    form.value = { name: '', email: '', message: '' }
  } finally {
    loading.value = false
  }
}
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
