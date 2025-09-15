<template>
  <section class="py-10 bg-gradient-to-tr from-amber-200 via-orange-100 to-yellow-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Render dinámico -->
        <div
          v-for="(item, index) in datos"
          :key="index"
          class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition"
        >
          <div class="flex justify-center mb-4">
            <img :src="item.imagen" alt="" class="w-10 h-10" />
          </div>
          <h3 class="text-xl font-bold mb-2">{{ item.titulo }}</h3>
          <p class="text-sm">{{ item.descripcion }}</p>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
interface Tarjeta {
  titulo: string
  descripcion: string
  imagen: string
  colorText: string
}

const datos: Tarjeta[] = [
  {
    titulo: "DESPACHO GRATIS EN R. METROPOLITANA",
    descripcion: "Por compras desde $100.000 + IVA",
    imagen: "/img/icons8-en-tránsito.gif",
    colorText: "text-white"
  },
  {
    titulo: "PRODUCTOS DE CALIDAD",
    descripcion: "Con altos estándares de exigencia y selección",
    imagen: "/img/icons8-garantía.gif",
    colorText: "text-dark-chocolate"
  },
  {
    titulo: "PAGO SEGURO",
    descripcion: "Aceptamos tarjetas de débito y crédito de forma segura",
    imagen: "/img/icons8-terminal-punto-de-venta.gif",
    colorText: "text-dark-chocolate"
  }
]
</script>
