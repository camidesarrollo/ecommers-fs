<template>
  <section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <!-- Encabezado -->
      <h2 class="text-3xl font-bold text-gray-800 mb-4">Propiedades Nutricionales</h2>
      <p class="text-gray-600 mb-10">Beneficios rápidos de nuestros frutos secos y snacks saludables</p>

      <!-- Grid de beneficios -->
      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div
          v-for="(prop, index) in propiedades"
          :key="index"
          class="bg-white rounded-lg shadow p-6 flex flex-col items-center hover:shadow-lg transition"
        >
          <div class="text-4xl mb-3">{{ prop.icono }}</div>
          <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ prop.titulo }}</h3>
          <p class="text-gray-600 text-sm">{{ prop.descripcion }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
interface Propiedad {
  titulo: string;
  descripcion: string;
  icono: string;
}

// Datos de ejemplo
const propiedades: Propiedad[] = [
  { titulo: "Proteínas", descripcion: "Aporta proteínas esenciales para tus músculos.", icono: "💪" },
  { titulo: "Energía", descripcion: "Perfecto para mantener tu energía durante el día.", icono: "⚡" },
  { titulo: "Antioxidantes", descripcion: "Ayuda a proteger tu cuerpo de radicales libres.", icono: "🛡️" },
  { titulo: "Snack Saludable", descripcion: "Ideal para picar sin culpas entre comidas.", icono: "🍏" }
];
</script>
