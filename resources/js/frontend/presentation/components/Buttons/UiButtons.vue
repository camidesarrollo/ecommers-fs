<template>
  <button
    :class="['px-4 py-2 rounded-lg font-semibold transition-colors', tipoColor]"
    @click="handleClick"
  >
    {{ label }}
  </button>
</template>

<script setup>
import { computed } from 'vue'
import { toRefs } from 'vue'

const props = defineProps({
  tipo: {
    type: String,
    default: 'default'
  },
  accion: {
    type: Function,
    default: null
  },
  label: {            // <-- Nueva prop para el texto
    type: String,
    default: ''
  }
})

const { tipo, accion } = toRefs(props)

const tipoMap = {
  agregar: { color: 'bg-green-olive text-white hover:bg-green-700' },
  eliminar: { color: 'bg-red-burgundy text-white hover:bg-red-800' },
  editar: { color: 'bg-golden-yellow text-dark-chocolate hover:bg-d4a017' },
  mas: { color: 'bg-mint-green text-dark-chocolate hover:bg-green-400' },
  menos: { color: 'bg-orange-warm text-white hover:bg-orange-600' },
  default: { color: 'bg-gray-light text-gray-dark hover:bg-gray-300' }
}

const tipoColor = computed(() => tipoMap[tipo.value]?.color || tipoMap.default.color)

const handleClick = () => {
  if (accion.value) accion.value()
}
</script>
