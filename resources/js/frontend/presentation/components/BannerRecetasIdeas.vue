<template>
  <section class="relative rounded-lg overflow-hidden shadow-lg">
    <!-- Imagen de fondo -->
    <img :src="imagen" :alt="titulo" class="w-full h-64 sm:h-80 md:h-96 object-cover" />

    <!-- Overlay con gradiente -->
    <div
      class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent flex flex-col justify-center items-start p-6 sm:p-12">
      <h2 class="text-3xl sm:text-4xl font-bold text-white drop-shadow-lg mb-2">{{ titulo }}</h2>
      <p class="text-white text-lg drop-shadow-md mb-4">{{ descripcion }}</p>
      <UiButtons :tipo="buttonType" :accion="handleNavigate" :label="buttonText" :icono="iconoBoton"
        :isFormValid="true" />
    </div>
  </section>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import UiButtons from './Buttons/UiButtons.vue'

// Import FontAwesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Importar íconos que usarás
import { 
  faBookOpen,
  faShoppingCart,
  faArrowRight,
  faCompass,
  faRss,
  faEnvelope,
  faUserPlus,
  faHome,
  faSearch,
  faShoppingBag
} from '@fortawesome/free-solid-svg-icons'

// Agregar íconos a la librería
library.add(
  faBookOpen,
  faShoppingCart,
  faArrowRight,
  faCompass,
  faRss,
  faEnvelope,
  faUserPlus,
  faHome,
  faSearch,
  faShoppingBag
)

// Registrar componente globalmente (si no lo has hecho en main.ts, se puede usar local)
defineExpose({ FontAwesomeIcon })

interface Props {
  titulo?: string
  descripcion?: string
  imagen?: string
  link?: string
  buttonText?: string
  buttonType?: string
  icono?: string
}

const props = withDefaults(defineProps<Props>(), {
  titulo: "Ideas para tus snacks",
  descripcion: "Descubre recetas fáciles, saludables y deliciosas con frutos secos en nuestro blog.",
  imagen: "/img/Banner_Frutos_secos2.jpeg",
  link: "/blog",
  buttonText: 'Ver Recetas',
  buttonType: 'agregar'
})

const emit = defineEmits<{
  navigate: [link: string]
}>()

// Mapeo inteligente de iconos según el texto del botón
const iconoBoton = computed(() => {
  if (props.icono) return props.icono

  const texto = props.buttonText.toLowerCase()

  if (texto.includes('receta')) return 'book-open'
  if (texto.includes('comprar') || texto.includes('shop')) return 'shopping-cart'
  if (texto.includes('ver') || texto.includes('explorar')) return 'arrow-right'
  if (texto.includes('descubr')) return 'compass'
  if (texto.includes('blog')) return 'rss'
  if (texto.includes('contact')) return 'envelope'
  if (texto.includes('registr')) return 'user-plus'
  if (texto.includes('inicio') || texto.includes('home')) return 'home'
  if (texto.includes('buscar')) return 'search'
  if (texto.includes('cart') || texto.includes('carrito')) return 'shopping-bag'

  return 'arrow-right'
})

const handleNavigate = () => {
  emit('navigate', props.link)
}

// Destructuring para usar en el template
const { titulo, descripcion, imagen, link, buttonText, buttonType } = props
</script>