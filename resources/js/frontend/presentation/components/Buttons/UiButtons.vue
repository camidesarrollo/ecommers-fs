<template>
  <button :class="[
      'w-full px-4 py-3 rounded-lg font-semibold transition-colors focus:outline-none focus:ring-4 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center',
      tipoColor,
      loading ? 'cursor-not-allowed opacity-50' : ''
    ]" 
    :disabled="loading || !isFormValid" 
    @click="handleClick"
  >
    <span v-if="!loading">
      <font-awesome-icon v-if="icono" :icon="[iconFamily, icono]" class="mr-2" />
      {{ label }}
    </span>
    <span v-else>
      <font-awesome-icon :icon="['fas', 'spinner']" class="mr-2 fa-spin" />
      {{ loadingText }}
    </span>
  </button>
</template>

<script>
import { computed, toRefs } from 'vue'

export default {
  name: 'UiButtons',
  props: {
    tipo: {
      type: String,
      default: 'default'
    },
    label: {
      type: String,
      default: ''
    },
    accion: {
      type: Function,
      default: null
    },
    icono: {
      type: String,
      default: 'user-plus'
    },
    iconFamily: {
      type: String,
      default: 'fas' // por defecto 'solid', pero ahora puedes usar 'fab' para WhatsApp
    },
    loading: {
      type: Boolean,
      default: false
    },
    loadingText: {
      type: String,
      default: 'Procesando...'
    },
    isFormValid: {
      type: Boolean,
      default: true
    }
  },
  setup(props) {
    const { tipo, accion } = toRefs(props)

    const tipoMap = {
      agregar: { color: 'bg-olive-green text-white hover:bg-olive-green-dark focus:ring-olive-green' },
      eliminar: { color: 'bg-burgundy-red text-white hover:bg-burgundy-red-dark focus:ring-burgundy-red' },
      editar: { color: 'bg-golden-yellow text-dark-chocolate hover:bg-golden-yellow-dark focus:ring-golden-yellow' },
      mas: { color: 'bg-mint-green text-dark-chocolate hover:bg-mint-green-dark focus:ring-mint-green' },
      menos: { color: 'bg-orange-warm text-white hover:bg-orange-warm-dark focus:ring-orange-warm' },
      default: { color: 'bg-gray-light text-gray-dark hover:bg-gray-light-dark focus:ring-gray-light' },
      informacion: { color: 'bg-white hover:bg-gray-50 border-2 border-yellow-400 text-yellow-600' },
      whatsapp: { color: 'bg-white hover:bg-gray-50 border-2 border-yellow-400 text-yellow-600' } // color WhatsApp
    }

    const tipoColor = computed(() => tipoMap[tipo.value]?.color || tipoMap.default.color)

    const handleClick = () => {
      if (accion.value) accion.value()
    }

    return {
      tipoColor,
      handleClick
    }
  }
}
</script>
