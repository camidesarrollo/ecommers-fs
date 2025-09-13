<template>
  <section
    class="relative w-full h-56 sm:h-64 md:h-80 lg:h-[28rem] bg-center bg-cover"
    style="background-image: url('/img/Banner_Frutos_secos.png')"
  >
    <!-- Overlay oscuro -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- Contenido -->
    <div class="relative flex flex-col items-center justify-center h-full text-center text-white px-4">
      <p class="uppercase tracking-widest text-xs sm:text-sm md:text-base">
        Mira todos nuestros
      </p>
      <h1 class="text-xl sm:text-3xl md:text-5xl font-extrabold mt-2">
        PRODUCTOS AQUÍ
      </h1>

      <!-- Botón CTA -->
      <a
        href="#productos"
        class="mt-4 inline-block bg-white text-black font-semibold px-4 sm:px-6 py-2 sm:py-3 rounded-full shadow-md hover:bg-gray-200 transition"
      >
        Ver más
      </a>
    </div>
  </section>
</template>

<script>
export default {
  name: "BannerProductos",
};
</script>
