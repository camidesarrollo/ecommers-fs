<template>
  <section class="py-12 bg-gradient-to-tr from-amber-200 via-orange-100 to-yellow-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Encabezado -->
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Packs y Suscripciones</h2>
        <p class="text-gray-600 mt-2">
          Elige el pack ideal para ti y ahorra con nuestra suscripción
        </p>
      </div>

      <!-- Tabla de packs -->
      <div class="grid gap-6 sm:grid-cols-3">
        <div
          v-for="(pack, index) in packs"
          :key="index"
          class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center hover:scale-105 transform transition"
        >
          <!-- Nombre del pack -->
          <h3 class="text-xl font-semibold text-gray-800 mb-2">
            {{ pack.nombre }}
          </h3>

          <!-- Precio -->
          <div class="text-3xl font-bold text-gray-900 mb-4">
            ${{ pack.precio.toFixed(2) }}
            <span
              v-if="pack.descuento"
              class="text-sm text-green-600 font-medium"
              >(-{{ pack.descuento }}%)</span
            >
          </div>

          <!-- Beneficios -->
          <ul class="mb-6 text-gray-600 text-sm space-y-2">
            <li
              v-for="(beneficio, i) in pack.beneficios"
              :key="i"
              class="flex items-center"
            >
              <svg
                class="w-4 h-4 text-green-500 mr-2"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
                  clip-rule="evenodd"
                />
              </svg>
              {{ beneficio }}
            </li>
          </ul>

          <!-- CTA con Button.vue -->
          <UiButtons
            :tipo="'agregar'"
            :accion="() => window.location.href = pack.link"
            :label="`Suscríbete y ahorra ${pack.descuento ?? 0}%`"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import UiButtons from "./Buttons/UiButtons.vue"; // ajusta la ruta según tu proyecto

interface Pack {
  nombre: string;
  precio: number;
  descuento?: number;
  beneficios: string[];
  link: string;
}

// Datos de ejemplo
const packs: Pack[] = [
  {
    nombre: "Pack Pequeño",
    precio: 19.99,
    beneficios: ["250g de frutos secos", "Envío mensual", "Recetas incluidas"],
    link: "/suscripcion/pequeno",
    descuento: 15,
  },
  {
    nombre: "Pack Mediano",
    precio: 34.99,
    beneficios: [
      "500g de frutos secos",
      "Envío mensual",
      "Recetas incluidas",
      "Descuento especial",
    ],
    link: "/suscripcion/mediano",
    descuento: 15,
  },
  {
    nombre: "Pack Grande",
    precio: 59.99,
    beneficios: [
      "1kg de frutos secos",
      "Envío mensual",
      "Recetas incluidas",
      "Regalo sorpresa",
      "Descuento especial",
    ],
    link: "/suscripcion/grande",
    descuento: 15,
  },
];
</script>
