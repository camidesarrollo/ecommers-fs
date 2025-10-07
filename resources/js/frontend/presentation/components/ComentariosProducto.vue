<template>
  <section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Encabezado de Reseñas -->
      <div class="mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">
          Reseñas de Clientes
        </h2>
        
        <!-- Resumen de Calificaciones -->
        <div class="bg-white rounded-xl shadow-md p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          
          <!-- Calificación Promedio -->
          <div class="flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-gray-200 pb-6 md:pb-0">
            <div class="text-5xl font-bold text-gray-800 mb-2">{{ promedioCalificacion }}</div>
            <div class="flex text-yellow-400 text-2xl mb-2">
              <span v-for="n in 5" :key="n">
                {{ n <= Math.round(promedioCalificacion) ? '★' : '☆' }}
              </span>
            </div>
            <p class="text-gray-600 text-sm">{{ totalComentarios }} reseñas</p>
          </div>

          <!-- Distribución de Estrellas -->
          <div class="space-y-2">
            <div v-for="(count, index) in distribucionEstrellas" :key="index" class="flex items-center gap-3">
              <span class="text-sm font-medium text-gray-700 w-16">{{ 5 - index }} estrellas</span>
              <div class="flex-1 bg-gray-200 rounded-full h-2">
                <div 
                  :style="{ width: `${(count / totalComentarios) * 100}%` }"
                  class="bg-yellow-400 h-2 rounded-full transition-all duration-300"
                ></div>
              </div>
              <span class="text-sm text-gray-600 w-8">{{ count }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Filtros -->
      <div class="flex flex-wrap gap-3 mb-6">
        <button
          @click="filtroSeleccionado = 'todos'"
          :class="filtroSeleccionado === 'todos' ? 'bg-yellow-400 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
          class="px-4 py-2 rounded-full font-medium transition"
        >
          Todas ({{ totalComentarios }})
        </button>
        <button
          v-for="n in 5"
          :key="n"
          @click="filtroSeleccionado = 6 - n"
          :class="filtroSeleccionado === (6 - n) ? 'bg-yellow-400 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
          class="px-4 py-2 rounded-full font-medium transition flex items-center gap-1"
        >
          <span>{{ 6 - n }}</span>
          <span class="text-yellow-400">★</span>
          <span>({{ distribucionEstrellas[5 - n] }})</span>
        </button>
      </div>

      <!-- Formulario para Agregar Comentario -->
      <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Deja tu opinión</h3>
        
        <form @submit.prevent="agregarComentario" class="space-y-4">
          
          <!-- Selector de Calificación -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Tu calificación <span class="text-red-500">*</span>
            </label>
            <div class="flex gap-2">
              <button
                v-for="n in 5"
                :key="n"
                type="button"
                @click="nuevoComentario.calificacion = n"
                @mouseenter="hoverCalificacion = n"
                @mouseleave="hoverCalificacion = 0"
                class="text-3xl transition-transform hover:scale-110"
                :class="n <= (hoverCalificacion || nuevoComentario.calificacion) ? 'text-yellow-400' : 'text-gray-300'"
              >
                ★
              </button>
            </div>
            <p v-if="errorCalificacion" class="text-red-500 text-sm mt-1">Por favor selecciona una calificación</p>
          </div>

          <!-- Grid de campos del usuario -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Nombre -->
            <div>
              <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                Nombre <span class="text-red-500">*</span>
              </label>
              <input
                id="nombre"
                v-model="nuevoComentario.nombre"
                type="text"
                placeholder="Tu nombre"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition"
                required
              />
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email <span class="text-red-500">*</span>
              </label>
              <input
                id="email"
                v-model="nuevoComentario.email"
                type="email"
                placeholder="tu@email.com"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition"
                required
              />
            </div>
          </div>

          <!-- Título del comentario -->
          <div>
            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">
              Título de tu reseña <span class="text-red-500">*</span>
            </label>
            <input
              id="titulo"
              v-model="nuevoComentario.titulo"
              type="text"
              placeholder="Resumen de tu experiencia"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition"
              required
            />
          </div>

          <!-- Comentario -->
          <div>
            <label for="comentario" class="block text-sm font-medium text-gray-700 mb-2">
              Tu opinión <span class="text-red-500">*</span>
            </label>
            <textarea
              id="comentario"
              v-model="nuevoComentario.comentario"
              rows="4"
              placeholder="Comparte tu experiencia con este producto..."
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition resize-none"
              required
            ></textarea>
            <p class="text-sm text-gray-500 mt-1">{{ nuevoComentario.comentario.length }} / 500 caracteres</p>
          </div>

          <!-- Checkbox de términos -->
          <div class="flex items-start gap-2">
            <input
              id="terminos"
              v-model="aceptaTerminos"
              type="checkbox"
              class="mt-1 w-4 h-4 text-yellow-400 border-gray-300 rounded focus:ring-yellow-400"
              required
            />
            <label for="terminos" class="text-sm text-gray-600">
              Acepto que mi reseña sea publicada y acepto los 
              <a href="/terminos" class="text-blue-500 hover:underline">términos y condiciones</a>
            </label>
          </div>

          <!-- Botón de envío -->
          <button
            type="submit"
            :disabled="enviando"
            class="w-full sm:w-auto bg-yellow-400 hover:bg-yellow-500 disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-bold py-3 px-8 rounded-lg transition flex items-center justify-center gap-2"
          >
            <svg v-if="enviando" class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ enviando ? 'Enviando...' : 'Publicar Reseña' }}
          </button>
        </form>
      </div>

      <!-- Lista de Comentarios -->
      <div class="space-y-4">
        <div v-if="comentariosFiltrados.length === 0" class="bg-white rounded-xl shadow-md p-8 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
          </svg>
          <p class="text-gray-600 text-lg">No hay reseñas con este filtro</p>
          <button @click="filtroSeleccionado = 'todos'" class="mt-4 text-blue-500 hover:underline font-medium">
            Ver todas las reseñas
          </button>
        </div>

        <div
          v-for="comentario in comentariosPaginados"
          :key="comentario.id"
          class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition"
        >
          <!-- Header del comentario -->
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-start gap-4 flex-1">
              <!-- Avatar -->
              <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                {{ comentario.nombre.charAt(0).toUpperCase() }}
              </div>
              
              <!-- Info del usuario -->
              <div class="flex-1">
                <h4 class="font-bold text-gray-800">{{ comentario.nombre }}</h4>
                <div class="flex items-center gap-2 mt-1">
                  <div class="flex text-yellow-400 text-sm">
                    <span v-for="n in 5" :key="n">
                      {{ n <= comentario.calificacion ? '★' : '☆' }}
                    </span>
                  </div>
                  <span class="text-gray-500 text-sm">{{ formatearFecha(comentario.fecha) }}</span>
                </div>
                <p v-if="comentario.verificado" class="text-green-600 text-xs mt-1 flex items-center gap-1">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                  </svg>
                  Compra verificada
                </p>
              </div>
            </div>

            <!-- Botón de utilidad -->
            <button
              @click="toggleUtil(comentario.id)"
              class="flex items-center gap-1 text-gray-500 hover:text-yellow-500 transition text-sm"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
              </svg>
              <span>{{ comentario.util }}</span>
            </button>
          </div>

          <!-- Título -->
          <h5 class="font-semibold text-gray-800 mb-2">{{ comentario.titulo }}</h5>

          <!-- Comentario -->
          <p class="text-gray-600 leading-relaxed">{{ comentario.comentario }}</p>

          <!-- Respuesta del vendedor -->
          <div v-if="comentario.respuesta" class="mt-4 pl-4 border-l-4 border-yellow-400 bg-yellow-50 p-4 rounded-r-lg">
            <div class="flex items-center gap-2 mb-2">
              <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
              </svg>
              <span class="font-semibold text-gray-800">Respuesta del vendedor</span>
            </div>
            <p class="text-gray-700 text-sm">{{ comentario.respuesta }}</p>
          </div>
        </div>
      </div>

      <!-- Paginación -->
      <div v-if="totalPaginas > 1" class="flex justify-center items-center gap-2 mt-8">
        <button
          @click="paginaActual--"
          :disabled="paginaActual === 1"
          class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition"
        >
          Anterior
        </button>
        
        <div class="flex gap-2">
          <button
            v-for="n in totalPaginas"
            :key="n"
            @click="paginaActual = n"
            :class="paginaActual === n ? 'bg-yellow-400 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
            class="w-10 h-10 border border-gray-300 rounded-lg font-medium transition"
          >
            {{ n }}
          </button>
        </div>

        <button
          @click="paginaActual++"
          :disabled="paginaActual === totalPaginas"
          class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition"
        >
          Siguiente
        </button>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';

const props = defineProps({
  productoId: {
    type: Number,
    required: true
  }
});

// Estados
const filtroSeleccionado = ref<number | string>('todos');
const paginaActual = ref(1);
const comentariosPorPagina = 5;
const enviando = ref(false);
const errorCalificacion = ref(false);
const hoverCalificacion = ref(0);
const aceptaTerminos = ref(false);

// Nuevo comentario
const nuevoComentario = ref({
  calificacion: 0,
  nombre: '',
  email: '',
  titulo: '',
  comentario: ''
});

// Datos de ejemplo (en producción vendrían de la API)
const comentarios = ref([
  {
    id: 1,
    nombre: 'María González',
    calificacion: 5,
    titulo: '¡Excelente producto!',
    comentario: 'Las almendras están deliciosas y muy frescas. La entrega fue rápida y el empaque perfecto. Definitivamente volveré a comprar.',
    fecha: new Date('2024-10-01'),
    verificado: true,
    util: 24,
    respuesta: 'Muchas gracias por tu comentario, María. Nos alegra mucho que hayas disfrutado nuestras almendras. ¡Esperamos verte pronto!'
  },
  {
    id: 2,
    nombre: 'Carlos Ramírez',
    calificacion: 4,
    titulo: 'Buena calidad',
    comentario: 'Producto de buena calidad, aunque esperaba que fueran un poco más grandes. El sabor es excelente.',
    fecha: new Date('2024-09-28'),
    verificado: true,
    util: 15,
    respuesta: null
  },
  {
    id: 3,
    nombre: 'Ana Silva',
    calificacion: 5,
    titulo: 'Perfectas para snacks',
    comentario: 'Son el snack perfecto para el trabajo. Muy nutritivas y sabrosas. El precio está muy bien.',
    fecha: new Date('2024-09-25'),
    verificado: true,
    util: 32,
    respuesta: null
  },
  {
    id: 4,
    nombre: 'Luis Fernández',
    calificacion: 3,
    titulo: 'Esperaba más',
    comentario: 'No son malas, pero he probado mejores. El precio es un poco alto para la cantidad.',
    fecha: new Date('2024-09-20'),
    verificado: false,
    util: 8,
    respuesta: 'Gracias por tu feedback, Luis. Tomamos en cuenta tus comentarios para mejorar.'
  },
  {
    id: 5,
    nombre: 'Patricia Morales',
    calificacion: 5,
    titulo: 'Recomendadas 100%',
    comentario: 'Las mejores almendras que he comprado online. Frescas, crujientes y deliciosas. Servicio impecable.',
    fecha: new Date('2024-09-15'),
    verificado: true,
    util: 45,
    respuesta: null
  }
]);

// Computed
const totalComentarios = computed(() => comentarios.value.length);

const promedioCalificacion = computed(() => {
  if (comentarios.value.length === 0) return 0;
  const suma = comentarios.value.reduce((acc, c) => acc + c.calificacion, 0);
  return parseFloat((suma / comentarios.value.length).toFixed(1));
});

const distribucionEstrellas = computed(() => {
  const dist = [0, 0, 0, 0, 0];
  comentarios.value.forEach(c => {
    dist[5 - c.calificacion]++;
  });
  return dist;
});

const comentariosFiltrados = computed(() => {
  if (filtroSeleccionado.value === 'todos') {
    return comentarios.value;
  }
  return comentarios.value.filter(c => c.calificacion === filtroSeleccionado.value);
});

const totalPaginas = computed(() => 
  Math.ceil(comentariosFiltrados.value.length / comentariosPorPagina)
);

const comentariosPaginados = computed(() => {
  const inicio = (paginaActual.value - 1) * comentariosPorPagina;
  const fin = inicio + comentariosPorPagina;
  return comentariosFiltrados.value.slice(inicio, fin);
});

// Métodos
const formatearFecha = (fecha: Date) => {
  const ahora = new Date();
  const diff = Math.floor((ahora.getTime() - fecha.getTime()) / (1000 * 60 * 60 * 24));
  
  if (diff === 0) return 'Hoy';
  if (diff === 1) return 'Ayer';
  if (diff < 7) return `Hace ${diff} días`;
  if (diff < 30) return `Hace ${Math.floor(diff / 7)} semanas`;
  
  return fecha.toLocaleDateString('es-CL', { year: 'numeric', month: 'long', day: 'numeric' });
};

const toggleUtil = (id: number) => {
  const comentario = comentarios.value.find(c => c.id === id);
  if (comentario) {
    comentario.util++;
  }
};

const agregarComentario = () => {
  // Validar calificación
  if (nuevoComentario.value.calificacion === 0) {
    errorCalificacion.value = true;
    return;
  }
  
  errorCalificacion.value = false;
  enviando.value = true;

  // Simular envío a la API
  setTimeout(() => {
    const comentario = {
      id: comentarios.value.length + 1,
      nombre: nuevoComentario.value.nombre,
      calificacion: nuevoComentario.value.calificacion,
      titulo: nuevoComentario.value.titulo,
      comentario: nuevoComentario.value.comentario,
      fecha: new Date(),
      verificado: false,
      util: 0,
      respuesta: null
    };

    comentarios.value.unshift(comentario);
    
    // Limpiar formulario
    nuevoComentario.value = {
      calificacion: 0,
      nombre: '',
      email: '',
      titulo: '',
      comentario: ''
    };
    aceptaTerminos.value = false;
    enviando.value = false;

    // Mensaje de éxito
    alert('¡Gracias por tu reseña! Será publicada después de ser revisada.');
  }, 1500);
};
</script>

<style scoped>
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.bg-white {
  animation: fadeIn 0.3s ease-out;
}
</style>