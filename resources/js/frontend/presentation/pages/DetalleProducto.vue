<template>
  <div class="min-h-screen bg-gray-50 py-6 sm:py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Breadcrumb -->
      <nav class="mb-6 text-sm">
        <ol class="flex items-center gap-2 text-gray-600">
          <li><a href="/" class="hover:text-yellow-500">Inicio</a></li>
          <li>/</li>
          <li><a href="/productos" class="hover:text-yellow-500">Productos</a></li>
          <li>/</li>
          <li class="text-gray-800 font-medium">{{ producto.nombre }}</li>
        </ol>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Columna Izquierda -->
      <aside class="hidden lg:block lg:col-span-3 space-y-6">
        <ServiciosCard orientation="vertical" />
        <ProductosDestacados orientation="vertical" />
      </aside>

        <!-- Columna Central -->
        <main class="lg:col-span-9">
          <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 sm:p-8">
              
              <!-- Galería de imágenes -->
              <div class="space-y-4">
                <div class="relative bg-gray-100 rounded-xl overflow-hidden aspect-square">
                  <img 
                    :src="imagenSeleccionada" 
                    :alt="producto.nombre"
                    class="w-full h-full object-cover"
                  />
                  
                  <!-- Badge de descuento -->
                  <div v-if="producto.descuento" class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full font-bold text-sm">
                    -{{ producto.descuento }}%
                  </div>

                  <!-- Navegación -->
                  <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-4">
                    <button @click="productoAnterior" class="bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition">
                      <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                      </svg>
                    </button>
                    <button @click="productoSiguiente" class="bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition">
                      <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Miniaturas -->
                <div class="flex gap-2 overflow-x-auto pb-2">
                  <button
                    v-for="(img, index) in producto.imagenes"
                    :key="index"
                    @click="imagenSeleccionada = img"
                    :class="imagenSeleccionada === img ? 'ring-2 ring-yellow-400' : 'ring-1 ring-gray-200'"
                    class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden hover:ring-2 hover:ring-yellow-400 transition"
                  >
                    <img :src="img" :alt="`Vista ${index + 1}`" class="w-full h-full object-cover" />
                  </button>
                </div>
              </div>

              <!-- Información del Producto -->
              <div class="space-y-6">
                <div>
                  <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ producto.nombre }}</h1>
                  <p class="text-gray-600 mb-4">{{ producto.subtitulo }}</p>
                  <div class="flex items-baseline gap-3 mb-4">
                    <span class="text-3xl font-bold text-yellow-600">${{ precioFinal.toLocaleString() }}</span>
                    <span v-if="producto.precioAnterior" class="text-xl text-gray-400 line-through">
                      ${{ producto.precioAnterior.toLocaleString() }}
                    </span>
                  </div>

                  <!-- Rating -->
                  <div class="flex items-center gap-2 text-sm">
                    <div class="flex text-yellow-400">
                      <span v-for="n in 5" :key="n">★</span>
                    </div>
                    <span class="text-gray-600">({{ producto.resenas }} reseñas)</span>
                  </div>
                </div>

                <!-- Descripción -->
                <div>
                  <h3 class="font-semibold text-gray-800 mb-2">Descripción</h3>
                  <p class="text-gray-600 leading-relaxed">{{ producto.descripcion }}</p>
                </div>

                <!-- Información Nutricional -->
                <div>
                  <button 
                    @click="mostrarNutricional = !mostrarNutricional"
                    class="flex items-center justify-between w-full font-semibold text-gray-800 mb-2"
                  >
                    <span>Información Nutricional</span>
                    <svg 
                      class="w-5 h-5 transition-transform" 
                      :class="{ 'rotate-180': mostrarNutricional }"
                      fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                  <transition name="slide-down">
                    <div v-if="mostrarNutricional" class="bg-gray-50 rounded-lg p-4 space-y-2">
                      <div v-for="(valor, nutriente) in producto.infoNutricional" :key="nutriente" class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ nutriente }}</span>
                        <span class="font-medium text-gray-800">{{ valor }}</span>
                      </div>
                    </div>
                  </transition>
                </div>

                <!-- Selector de Cantidad -->
                <div>
                  <label class="block font-semibold text-gray-800 mb-2">Cantidad</label>
                  <div class="flex items-center gap-4">
                    <div class="flex items-center border border-gray-300 rounded-lg">
                      <button @click="decrementarCantidad" class="px-4 py-2 hover:bg-gray-100 transition">-</button>
                      <span class="px-6 py-2 font-medium">{{ cantidad }}</span>
                      <button @click="incrementarCantidad" class="px-4 py-2 hover:bg-gray-100 transition">+</button>
                    </div>
                    <span class="text-sm text-gray-600">{{ producto.stock }} disponibles</span>
                  </div>
                </div>

                <!-- Botones de Acción -->
                <div class="space-y-3">
                  <!-- Agregar al carrito -->
                  <UiButtons 
                    tipo="agregar" 
                    :accion="agregarAlCarrito" 
                    label="Agregar al carrito" 
                    class="w-full" 
                    icono="cart-plus" 
                  />

                  <!-- Pedir más información vía WhatsApp -->
                  <UiButtons 
                    tipo="whatsapp" 
                    :accion="pedirInformacion" 
                    label="Pedir Más Información" 
                    class="font-bold py-3 rounded-lg transition flex items-center justify-center gap-2 w-full" 
                    icono="whatsapp" 
                    iconFamily="fab"
                  />
                </div>

                <!-- Características adicionales -->
                <div class="border-t pt-4 space-y-2 text-sm">
                  <div class="flex items-center gap-2 text-gray-600">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Envío gratis en compras sobre $100.000
                  </div>
                  <div class="flex items-center gap-2 text-gray-600">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Garantía de calidad certificada
                  </div>
                  <div class="flex items-center gap-2 text-gray-600">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Devolución sin costo dentro de 30 días
                  </div>
                </div>
              </div>
            </div>

            <!-- Productos Relacionados -->
            <div class="border-t bg-gray-50 p-6 sm:p-8">
              <ProductosRelacionados :categoria="producto.categoria" :productoActual="producto.id" />
            </div>
          </div>

        </main>

      </div>
              <!-- Agregar después de ProductosRelacionados -->
        <ComentariosProducto :productoId="producto.id" />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import ServiciosCard from '../components/Servicios.vue';
import ProductosDestacados from '../components/ProductosDestacados.vue';
import ProductosRelacionados from '../components/ProductosRelacionados.vue';
import  ComentariosProducto from '../components/ComentariosProducto.vue';
import UiButtons from '../components/Buttons/UiButtons.vue';

const props = defineProps({ productoId: { type: Number, required: true } });

const cantidad = ref(1);
const mostrarNutricional = ref(false);
const imagenSeleccionada = ref('');

const producto = ref({
  id: 1,
  nombre: 'Almendras Premium Natural',
  subtitulo: '500g - Origen California',
  descripcion: 'Almendras naturales de la más alta calidad, seleccionadas cuidadosamente. Ricas en proteínas, fibra y grasas saludables. Perfectas para snacks o agregar a tus comidas.',
  precio: 12990,
  precioAnterior: 15990,
  descuento: 20,
  stock: 45,
  resenas: 127,
  categoria: 'frutos-secos',
  imagenes: [
    'https://images.unsplash.com/photo-1611078481039-0e118f2e503f?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1508747703725-719777637510?auto=format&fit=crop&w=800&q=80'
  ],
  infoNutricional: {
    'Calorías': '579 kcal',
    'Proteínas': '21g',
    'Grasas totales': '50g',
    'Carbohidratos': '22g',
    'Fibra': '12g',
    'Sodio': '1mg'
  }
});

imagenSeleccionada.value = producto.value.imagenes[0];

const precioFinal = computed(() => producto.value.descuento
  ? producto.value.precio * (1 - producto.value.descuento / 100)
  : producto.value.precio
);

const incrementarCantidad = () => { if (cantidad.value < producto.value.stock) cantidad.value++; };
const decrementarCantidad = () => { if (cantidad.value > 1) cantidad.value--; };

const agregarAlCarrito = () => {
  console.log(`Agregando ${cantidad.value} unidades al carrito`);
  alert(`¡${cantidad.value} ${producto.value.nombre} agregado(s) al carrito!`);
};

// Función WhatsApp
const pedirInformacion = () => {
  window.open(`https://wa.me/56912345678?text=Hola, necesito información sobre ${producto.value.nombre}`, '_blank');
};

const productoAnterior = () => { console.log('Producto anterior'); };
const productoSiguiente = () => { console.log('Producto siguiente'); };
</script>

<style scoped>
.slide-down-enter-active,
.slide-down-leave-active { transition: all 0.3s ease-out; }
.slide-down-enter-from,
.slide-down-leave-to { max-height: 0; opacity: 0; overflow: hidden; }
.slide-down-enter-to,
.slide-down-leave-from { max-height: 400px; opacity: 1; }
</style>
