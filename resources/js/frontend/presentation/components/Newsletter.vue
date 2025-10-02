<template>
  <section
    class="relative bg-gradient-to-r from-yellow-400 via-orange-300 to-pink-400 rounded-lg overflow-hidden shadow-lg py-12"
  >
    <!-- Fondo decorativo -->
    <div class="absolute inset-0">
      <img
        :src="newsletterBg"
        alt="Fondo newsletter"
        class="w-full h-full object-cover opacity-20"
      />
    </div>

    <!-- Contenido -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
      <!-- Título -->
      <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
        Suscríbete a nuestro newsletter
      </h2>
      <p class="text-white text-lg mb-6">
        Recibe <span class="font-semibold">10% de descuento</span> en tu primera compra y acceso a recetas exclusivas y tips saludables.
      </p>

      <!-- Formulario -->
      <form
        @submit.prevent="suscribirse"
        class="flex flex-col sm:flex-row justify-center gap-3 max-w-xl mx-auto"
      >
        <input
          v-model="email"
          type="email"
          placeholder="Ingresa tu email"
          class="w-full sm:flex-1 px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-white"
          required
        />

        <!-- Botón personalizado -->
        <UiButtons
          tipo="agregar"
          :accion="suscribirse"
          label="Suscribirme"
        />
      </form>

      <!-- Mensaje de éxito -->
      <p v-if="mensaje" class="mt-4 text-white font-medium">{{ mensaje }}</p>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import UiButtons from './Buttons/UiButtons.vue' // Importamos el componente

const email = ref('')
const mensaje = ref('')

// Imagen de fondo desde public
const newsletterBg = '/img/NewsletterFondo.jpeg'

const suscribirse = () => {
  mensaje.value = `¡Gracias por suscribirte, ${email.value}! Revisa tu correo para el descuento.`
  email.value = ''
}
</script>

<style scoped>
/* Efecto suave al pasar el mouse sobre la sección */
section:hover img {
  transform: scale(1.02);
  transition: transform 0.3s ease;
}
</style>
