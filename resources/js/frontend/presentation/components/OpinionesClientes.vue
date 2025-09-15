<template>
  <section class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Opiniones de Nuestros Clientes</h2>
        <p class="text-gray-600 mt-2">Lo que dicen quienes ya disfrutan de nuestros productos</p>
      </div>

      <!-- Grid de reseñas -->
      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div
          v-for="(review, index) in opiniones"
          :key="index"
          class="bg-gray-50 rounded-lg shadow p-4 flex flex-col items-center text-center"
        >
          <!-- Foto del cliente -->
          <img
            :src="review.foto"
            :alt="review.nombre"
            class="w-16 h-16 rounded-full mb-3 object-cover"
          />

          <!-- Nombre -->
          <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ review.nombre }}</h3>

          <!-- Estrellas -->
          <div class="flex mb-2">
            <span v-for="n in 5" :key="n" class="text-yellow-400">
              <svg
                v-if="n <= review.estrellas"
                class="w-4 h-4 fill-current"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path d="M10 15l-5.878 3.09L5.5 12.545 1 8.91l6.061-.545L10 2l2.939 6.364L19 8.91l-4.5 3.636 1.378 5.545z"/>
              </svg>
              <svg
                v-else
                class="w-4 h-4 text-gray-300 fill-current"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path d="M10 15l-5.878 3.09L5.5 12.545 1 8.91l6.061-.545L10 2l2.939 6.364L19 8.91l-4.5 3.636 1.378 5.545z"/>
              </svg>
            </span>
          </div>

          <!-- Texto de la reseña -->
          <p class="text-gray-600 text-sm">{{ review.texto }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
interface Opinion {
  nombre: string;
  foto: string;
  estrellas: number; // 1 a 5
  texto: string;
}

// Datos de ejemplo
const opiniones: Opinion[] = [
  {
    nombre: "María P.",
    foto: "/img/clientes/maria.jpg",
    estrellas: 5,
    texto: "¡Los frutos secos son de excelente calidad! Muy recomendados."
  },
  {
    nombre: "Carlos R.",
    foto: "/img/clientes/carlos.jpg",
    estrellas: 4,
    texto: "Buen sabor y entrega rápida. Repetiré mi compra seguro."
  },
  {
    nombre: "Lucía G.",
    foto: "/img/clientes/lucia.jpg",
    estrellas: 5,
    texto: "Ideal para snacks saludables en el trabajo. ¡Me encantan!"
  },
  {
    nombre: "Jorge M.",
    foto: "/img/clientes/jorge.jpg",
    estrellas: 4,
    texto: "Productos frescos y presentación impecable. Muy satisfecho."
  }
];
</script>
