<template>
  <transition name="alert">
    <div
      v-if="modelValue"
      class="alert-container rounded-lg shadow-lg p-4 mb-4 flex items-start gap-4 relative overflow-hidden"
      :class="[alertClasses, sizeClasses]"
      role="alert">
      
      <!-- Barra lateral decorativa -->
      <div class="alert-border absolute left-0 top-0 bottom-0 w-1" :class="borderClasses"></div>

      <!-- Icono -->
      <div class="alert-icon flex-shrink-0" :class="iconSizeClasses">
        <slot name="icon">
          <span class="text-2xl">{{ defaultIcon }}</span>
        </slot>
      </div>

      <!-- Contenido -->
      <div class="alert-content flex-1 min-w-0">
        <!-- Título -->
        <h4 v-if="title" class="alert-title font-bold mb-1" :class="titleSizeClasses">
          {{ title }}
        </h4>
        
        <!-- Mensaje -->
        <div class="alert-message" :class="messageSizeClasses">
          <slot>
            {{ message }}
          </slot>
        </div>

        <!-- Slot para acciones -->
        <div v-if="$slots.actions" class="alert-actions mt-3 flex gap-2">
          <slot name="actions"></slot>
        </div>
      </div>

      <!-- Botón cerrar -->
      <button
        v-if="closable"
        @click="close"
        class="alert-close flex-shrink-0 hover:opacity-70 transition-opacity p-1 rounded"
        :class="closeButtonClasses"
        aria-label="Cerrar alerta">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'UiAlert',

  props: {
    modelValue: {
      type: Boolean,
      default: true
    },
    type: {
      type: String,
      default: 'info',
      validator: (value) => ['success', 'warning', 'error', 'info', 'neutral'].includes(value)
    },
    variant: {
      type: String,
      default: 'filled',
      validator: (value) => ['filled', 'outlined', 'soft'].includes(value)
    },
    size: {
      type: String,
      default: 'medium',
      validator: (value) => ['small', 'medium', 'large'].includes(value)
    },
    title: {
      type: String,
      default: ''
    },
    message: {
      type: String,
      default: ''
    },
    icon: {
      type: String,
      default: ''
    },
    closable: {
      type: Boolean,
      default: true
    },
    autoClose: {
      type: [Number, Boolean],
      default: false
    }
  },

  emits: ['update:modelValue', 'close'],

  data() {
    return {
      timer: null
    };
  },

  computed: {
    alertClasses() {
      const typeVariants = {
        success: {
          filled: 'bg-olive-green text-white',
          outlined: 'bg-white border-2 border-olive-green text-dark-chocolate',
          soft: 'bg-mint-green bg-opacity-30 border border-olive-green text-dark-chocolate'
        },
        warning: {
          filled: 'bg-orange-warm text-white',
          outlined: 'bg-white border-2 border-orange-warm text-dark-chocolate',
          soft: 'bg-golden-yellow bg-opacity-30 border border-orange-warm text-dark-chocolate'
        },
        error: {
          filled: 'bg-burgundy-red text-white',
          outlined: 'bg-white border-2 border-burgundy-red text-dark-chocolate',
          soft: 'bg-burgundy-red bg-opacity-10 border border-burgundy-red text-burgundy-red'
        },
        info: {
          filled: 'bg-golden-yellow text-dark-chocolate',
          outlined: 'bg-white border-2 border-golden-yellow text-dark-chocolate',
          soft: 'bg-golden-yellow bg-opacity-20 border border-golden-yellow text-dark-chocolate'
        },
        neutral: {
          filled: 'bg-nut-brown text-white',
          outlined: 'bg-white border-2 border-nut-brown text-dark-chocolate',
          soft: 'bg-beige border border-nut-brown text-dark-chocolate'
        }
      };

      return typeVariants[this.type][this.variant];
    },

    borderClasses() {
      const colors = {
        success: 'bg-olive-green-dark',
        warning: 'bg-orange-warm',
        error: 'bg-burgundy-red-dark',
        info: 'bg-golden-yellow-dark',
        neutral: 'bg-nut-brown-dark'
      };
      return colors[this.type];
    },

    sizeClasses() {
      const sizes = {
        small: 'text-sm',
        medium: 'text-base',
        large: 'text-lg'
      };
      return sizes[this.size];
    },

    titleSizeClasses() {
      const sizes = {
        small: 'text-sm',
        medium: 'text-base',
        large: 'text-xl'
      };
      return sizes[this.size];
    },

    messageSizeClasses() {
      const sizes = {
        small: 'text-xs',
        medium: 'text-sm',
        large: 'text-base'
      };
      return sizes[this.size];
    },

    iconSizeClasses() {
      const sizes = {
        small: 'text-lg',
        medium: 'text-2xl',
        large: 'text-3xl'
      };
      return sizes[this.size];
    },

    closeButtonClasses() {
      return this.variant === 'filled' && ['success', 'error', 'neutral'].includes(this.type)
        ? 'text-white'
        : 'text-dark-chocolate';
    },

    defaultIcon() {
      if (this.icon) return this.icon;
      
      const icons = {
        success: '✓',
        warning: '⚠️',
        error: '✕',
        info: 'ℹ️',
        neutral: '📋'
      };
      return icons[this.type];
    }
  },

  mounted() {
    if (this.autoClose && typeof this.autoClose === 'number') {
      this.startAutoClose();
    }
  },

  beforeUnmount() {
    this.clearAutoClose();
  },

  methods: {
    close() {
      this.$emit('update:modelValue', false);
      this.$emit('close');
      this.clearAutoClose();
    },

    startAutoClose() {
      this.timer = setTimeout(() => {
        this.close();
      }, this.autoClose);
    },

    clearAutoClose() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
    }
  }
};
</script>

<style scoped>
/* Variables de colores */
.bg-olive-green {
  background-color: var(--color-olive-green, #6B8E23);
}

.bg-olive-green-dark {
  background-color: var(--color-olive-green-dark, #556B1A);
}

.bg-nut-brown {
  background-color: var(--color-nut-brown, #8B5E3C);
}

.bg-nut-brown-dark {
  background-color: var(--color-nut-brown-dark, #6B4529);
}

.bg-golden-yellow {
  background-color: var(--color-golden-yellow, #F4C430);
}

.bg-golden-yellow-dark {
  background-color: var(--color-golden-yellow-dark, #D4A017);
}

.bg-burgundy-red {
  background-color: var(--color-burgundy-red, #8B0000);
}

.bg-burgundy-red-dark {
  background-color: var(--color-burgundy-red-dark, #650000);
}

.bg-beige {
  background-color: var(--color-beige, #F5F5DC);
}

.bg-mint-green {
  background-color: var(--color-mint-green, #98FF98);
}

.bg-orange-warm {
  background-color: var(--color-orange-warm, #FF8C00);
}

.text-dark-chocolate {
  color: var(--color-dark-chocolate, #3B2F2F);
}

.border-olive-green {
  border-color: var(--color-olive-green, #6B8E23);
}

.border-nut-brown {
  border-color: var(--color-nut-brown, #8B5E3C);
}

.border-golden-yellow {
  border-color: var(--color-golden-yellow, #F4C430);
}

.border-orange-warm {
  border-color: var(--color-orange-warm, #FF8C00);
}

.border-burgundy-red {
  border-color: var(--color-burgundy-red, #8B0000);
}

/* Transiciones */
.alert-enter-active,
.alert-leave-active {
  transition: all 0.3s ease;
}

.alert-enter-from {
  opacity: 0;
  transform: translateY(-20px);
}

.alert-leave-to {
  opacity: 0;
  transform: translateX(100%);
}

/* Contenedor de alerta */
.alert-container {
  position: relative;
  padding-left: 1.25rem;
}

.alert-border {
  border-radius: 0.5rem 0 0 0.5rem;
}
</style>

<!-- EJEMPLO DE USO
 
<template>
  <div class="space-y-4 p-8">
    <UiAlert
      v-model="showSuccess"
      type="success"
      variant="filled"
      title="¡Pedido exitoso!"
      message="Tu pedido de frutos secos ha sido procesado correctamente."
      :closable="true"
      :auto-close="5000">
    </UiAlert>

    <UiAlert
      v-model="showWarning"
      type="warning"
      variant="soft"
      title="Stock bajo"
      size="medium">
      <p>Solo quedan <strong>5 unidades</strong> de almendras premium.</p>
      <template #actions>
        <UiButtons class="btn-add text-sm px-3 py-1">
          Reabastecer
        </button>
      </template>
    </UiAlert>

    <UiAlert
      v-model="showError"
      type="error"
      variant="outlined"
      title="Error de pago"
      message="No se pudo procesar tu tarjeta. Intenta nuevamente."
      icon="❌">
    </UiAlert>

    <UiAlert
      v-model="showInfo"
      type="info"
      variant="filled"
      size="large"
      :closable="false">
      <template #icon>
        <span class="text-3xl">🌰</span>
      </template>
      <template #default>
        <h4 class="font-bold mb-2">Nueva temporada</h4>
        <p>Ya disponibles nuestras nueces de temporada 2025.</p>
      </template>
    </UiAlert>

    <UiAlert
      v-model="showNeutral"
      type="neutral"
      variant="soft"
      size="small"
      message="Recordatorio: Actualiza tu inventario mensualmente.">
    </UiAlert>

    <div class="flex gap-2 flex-wrap">
      <UiButtons @click="showSuccess = true" class="btn-add">Mostrar Success</button>
      <UiButtons @click="showWarning = true" class="btn-edit">Mostrar Warning</button>
      <UiButtons @click="showError = true" class="btn-delete">Mostrar Error</button>
      <UiButtons @click="showInfo = true" class="bg-golden-yellow text-dark-chocolate px-4 py-2 rounded-lg font-semibold">
        Mostrar Info
      </button>
      <UiButtons @click="showNeutral = true" class="bg-nut-brown text-white px-4 py-2 rounded-lg font-semibold">
        Mostrar Neutral
      </button>
    </div>
  </div>
</template>

<script>
import UiAlert from '@/components/UiAlert.vue';

export default {
  components: {
    UiAlert
  },

  data() {
    return {
      showSuccess: true,
      showWarning: true,
      showError: true,
      showInfo: true,
      showNeutral: true
    };
  }
};
</script>
-->