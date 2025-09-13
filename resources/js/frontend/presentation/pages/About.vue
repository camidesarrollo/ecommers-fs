<template>
  <div class="min-h-screen bg-gradient-to-br from-yellow-50 to-yellow-100 text-gray-800">
    <!-- Sección Hero -->
    <section class="relative overflow-hidden py-20 bg-gradient-to-r from-yellow-400 to-pink-400 text-white">
      <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-4">Quiénes Somos</h1>
        <p class="text-xl md:text-2xl opacity-90 max-w-2xl mx-auto">
          Más que frutos secos, compartimos calidad, sabor y tradición en cada producto.
        </p>
      </div>
      <!-- Emojis flotantes -->
      <div class="absolute inset-0 opacity-20">
        <div class="absolute animate-bounce" style="top: 20%; left: 15%; font-size: 4rem;">🌰</div>
        <div class="absolute animate-bounce delay-200" style="top: 60%; right: 20%; font-size: 5rem;">🥜</div>
        <div class="absolute animate-bounce delay-500" style="bottom: 10%; left: 30%; font-size: 3.5rem;">🥥</div>
      </div>
    </section>

    <!-- Sección Historia -->
    <section class="py-16">
      <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-12 items-center">
        <img 
          src="https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2" 
          alt="Frutos secos naturales" 
          class="rounded-2xl shadow-lg w-full object-cover"
        />
        <div>
          <h2 class="text-3xl font-bold mb-4">Nuestra Historia</h2>
          <p class="text-lg mb-4 leading-relaxed">
            Nacimos con la pasión de ofrecer frutos secos <span class="font-semibold">naturales, frescos y de primera calidad</span>. 
            Desde el inicio, trabajamos con productores locales e internacionales para seleccionar lo mejor de cada cosecha.
          </p>
          <p class="text-lg leading-relaxed">
            Hoy, somos una comunidad que comparte el amor por una <span class="font-semibold">alimentación saludable y deliciosa</span>.
          </p>
        </div>
      </div>
    </section>

    <!-- Misión y Visión -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6 lg:px-12 grid md:grid-cols-2 gap-10">
        <div class="p-8 rounded-2xl shadow-md bg-gradient-to-br from-green-100 to-green-200">
          <h3 class="text-2xl font-bold mb-3">🌱 Nuestra Misión</h3>
          <p class="text-lg leading-relaxed">
            Promover un estilo de vida saludable acercando a cada hogar frutos secos premium, 
            con el compromiso de <span class="font-semibold">calidad, frescura y sostenibilidad</span>.
          </p>
        </div>
        <div class="p-8 rounded-2xl shadow-md bg-gradient-to-br from-pink-100 to-pink-200">
          <h3 class="text-2xl font-bold mb-3">🌎 Nuestra Visión</h3>
          <p class="text-lg leading-relaxed">
            Ser referentes en la venta de frutos secos a nivel nacional, 
            aportando al <span class="font-semibold">bienestar de las personas y al cuidado del planeta</span>.
          </p>
        </div>
      </div>
    </section>

    <!-- Equipo -->
    <section class="py-16">
      <div class="container mx-auto px-6 lg:px-12 text-center">
        <h2 class="text-3xl font-bold mb-12">Nuestro Equipo</h2>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="bg-white shadow-md rounded-2xl p-6 hover:scale-105 transition">
            <img 
              src="https://randomuser.me/api/portraits/women/44.jpg" 
              alt="Fundadora" 
              class="w-32 h-32 mx-auto rounded-full mb-4 shadow-md"
            />
            <h4 class="font-bold text-xl">Camila Rojas</h4>
            <p class="text-gray-500">Fundadora & CEO</p>
          </div>
          <div class="bg-white shadow-md rounded-2xl p-6 hover:scale-105 transition">
            <img 
              src="https://randomuser.me/api/portraits/men/32.jpg" 
              alt="Gerente Comercial" 
              class="w-32 h-32 mx-auto rounded-full mb-4 shadow-md"
            />
            <h4 class="font-bold text-xl">Diego Pérez</h4>
            <p class="text-gray-500">Gerente Comercial</p>
          </div>
          <div class="bg-white shadow-md rounded-2xl p-6 hover:scale-105 transition">
            <img 
              src="https://randomuser.me/api/portraits/women/65.jpg" 
              alt="Nutricionista" 
              class="w-32 h-32 mx-auto rounded-full mb-4 shadow-md"
            />
            <h4 class="font-bold text-xl">Valentina Gómez</h4>
            <p class="text-gray-500">Nutricionista</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-yellow-400 to-pink-400 text-center text-white">
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Descubre el sabor de lo natural</h2>
      <button class="bg-white text-yellow-600 font-bold px-8 py-3 rounded-full shadow-md hover:brightness-105 transition">
        Explorar Productos
      </button>
    </section>
  </div>
</template>

<script>
export default {
  name: "About",
};
</script>

<style scoped>
/* Animación personalizada opcional */
.animate-bounce {
  animation: bounce 3s infinite;
}
.animate-bounce.delay-200 {
  animation-delay: 0.2s;
}
.animate-bounce.delay-500 {
  animation-delay: 0.5s;
}
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-15px); }
}
</style>
