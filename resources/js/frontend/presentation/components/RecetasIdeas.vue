<template>
  <section class="relative rounded-lg overflow-hidden shadow-lg">
    <!-- Imagen de fondo -->
    <img 
      :src="imagen" 
      :alt="titulo" 
      class="w-full h-64 sm:h-80 md:h-96 object-cover"
    />

    <!-- Overlay con gradiente -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent flex flex-col justify-center items-start p-6 sm:p-12">
      <h2 class="text-3xl sm:text-4xl font-bold text-white drop-shadow-lg mb-2">{{ titulo }}</h2>
      <p class="text-white text-lg drop-shadow-md mb-4">{{ descripcion }}</p>
      <a 
        :href="link" 
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded drop-shadow-md"
      >
        Ver Recetas
      </a>
    </div>
  </section>
</template>

<script setup lang="ts">
interface Banner {
  titulo: string;
  descripcion: string;
  imagen: string;
  link: string;
}

// Datos de ejemplo
const banner: Banner = {
  titulo: "Ideas para tus snacks",
  descripcion: "Descubre recetas fáciles, saludables y deliciosas con frutos secos en nuestro blog.",
  imagen: "/img/Banner_Frutos_secos2.jpeg",
  link: "/blog"
}

// Binding para usar directamente en template
const { titulo, descripcion, imagen, link } = banner;
</script>
