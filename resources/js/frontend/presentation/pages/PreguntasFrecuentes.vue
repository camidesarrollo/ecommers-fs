<template>
  <div class="min-h-screen bg-gradient-to-br from-yellow-50 to-yellow-100 text-gray-800">
    <!-- Hero -->
    <section class="bg-gradient-to-r from-yellow-400 to-pink-400 text-white py-20 text-center relative overflow-hidden">
      <h1 class="text-5xl md:text-6xl font-extrabold mb-4">Preguntas Frecuentes</h1>
      <p class="text-xl md:text-2xl opacity-90 max-w-2xl mx-auto">
        Encuentra respuestas a las dudas más comunes sobre nuestros productos y servicios.
      </p>
      <!-- Emoji flotante -->
      <div class="absolute inset-0 opacity-20">
        <div class="absolute animate-bounce" style="top:20%; left:10%; font-size:4rem;">🌰</div>
        <div class="absolute animate-bounce delay-200" style="top:50%; right:15%; font-size:5rem;">🥜</div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16">
      <div class="container mx-auto px-6 lg:px-12 max-w-3xl">
        <h2 class="text-3xl font-bold mb-8 text-center">Respuestas rápidas a tus preguntas</h2>
        
        <div v-for="(item, index) in faqs" :key="index" class="mb-4 border border-gray-200 rounded-xl overflow-hidden shadow-sm">
          <button @click="toggle(index)" 
                  class="w-full text-left px-6 py-4 bg-white flex justify-between items-center hover:bg-gray-50 transition">
            <span class="font-semibold text-lg">{{ item.question }}</span>
            <svg v-if="activeIndex === index" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div v-show="activeIndex === index" class="px-6 py-4 bg-gray-50 text-gray-700">
            {{ item.answer }}
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-yellow-400 to-pink-400 text-center text-white">
      <h2 class="text-3xl md:text-4xl font-bold mb-6">¿No encontraste tu respuesta?</h2>
      <router-link to="/contacto" 
        class="bg-white text-yellow-600 font-bold px-8 py-3 rounded-full shadow-md hover:brightness-105 transition">
        Contáctanos
      </router-link>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const faqs = ref([
  { question: "¿Cómo puedo realizar un pedido?", answer: "Puedes realizar tu pedido directamente desde nuestra página, agregando los productos al carrito y completando el formulario de compra." },
  { question: "¿Hacen envíos a todo Chile?", answer: "Sí, realizamos envíos a todas las regiones de Chile con empresas de logística confiables y entrega rápida." },
  { question: "¿Puedo cambiar o cancelar mi pedido?", answer: "Los cambios o cancelaciones deben solicitarse dentro de las primeras 24 horas después de realizar el pedido, contactándonos directamente." },
  { question: "¿Los productos son 100% naturales?", answer: "Sí, todos nuestros frutos secos son seleccionados cuidadosamente y libres de aditivos o conservantes." },
  { question: "¿Tienen descuentos por compras al por mayor?", answer: "Sí, ofrecemos descuentos especiales para compras al por mayor. Contáctanos para más información." },
]);

const activeIndex = ref(null);

const toggle = (index) => {
  activeIndex.value = activeIndex.value === index ? null : index;
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
