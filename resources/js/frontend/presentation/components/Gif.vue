<template>
  <section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Título -->
      <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">
        Producto en Acción
      </h2>

      <!-- Video / GIF Card -->
      <div
        class="video-card relative max-w-4xl mx-auto rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300"
      >
        <!-- Video / GIF -->
        <video
          v-if="videoUrl"
          :src="videoUrl"
          autoplay
          loop
          muted
          playsinline
          class="w-full h-auto object-cover"
        ></video>
        <img
          v-else-if="gifUrl"
          :src="gifUrl"
          alt="Producto animado"
          class="w-full h-auto object-cover"
        />

        <!-- Overlay con información -->
        <div class="absolute inset-0 bg-black/30 flex flex-col justify-end p-6">
          <h3 class="text-2xl font-bold text-white mb-2">{{ title }}</h3>
          <p class="text-white text-sm mb-4">{{ description }}</p>

          <!-- Botón con componente Button.vue -->
          <Button
            :tipo="'agregar'"
            :accion="$emit.bind($, 'cta-click')"
            :label="'Llévalo ahora'"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import Button from "./Button.vue"; // ajusta la ruta según tu proyecto

const props = defineProps<{
  videoUrl?: string;   // URL del video mp4
  gifUrl?: string;     // URL del GIF
  title: string;       // Título principal
  description: string; // Descripción breve del producto
}>();

// Para pruebas temporales con GIF
const temporaryGif1 = "/img/495596331017201.gif";
const temporaryGif2 = "/img/495596143038201.gif";

// Ejemplo: usar uno de los GIFs si no se pasa video
const gifUrl = props.gifUrl ?? temporaryGif1;
</script>

<style scoped>
.video-card:hover video,
.video-card:hover img {
  transform: scale(1.02);
  transition: transform 0.3s ease;
}
</style>
