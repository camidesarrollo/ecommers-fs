<template>
  <Transition name="toast" appear>
    <div v-if="show" class="fixed top-4 right-4 z-50 max-w-sm">
      <div class="bg-white border-l-4 rounded-lg shadow-lg p-4" :class="borderClass">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <font-awesome-icon :icon="icon" :class="iconClass" />
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-dark-chocolate">{{ message }}</p>
          </div>
          <button @click="$emit('close')" class="ml-auto text-gray-400 hover:text-gray-600">
            <font-awesome-icon :icon="['fas', 'times']" />
          </button>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script>
export default {
  name: 'ToastNotification',
  props: {
    show: { type: Boolean, required: true },
    type: { type: String, default: 'info' }, // info, success, warning, error
    message: { type: String, required: true }
  },
  computed: {
    borderClass() {
      switch (this.type) {
        case 'success': return 'border-olive-green'
        case 'error': return 'border-burgundy-red'
        case 'warning': return 'border-orange-warm'
        default: return 'border-gray-dark'
      }
    },
    icon() {
      switch (this.type) {
        case 'success': return ['fas', 'check-circle']
        case 'error': return ['fas', 'times-circle']
        case 'warning': return ['fas', 'exclamation-triangle']
        default: return ['fas', 'info-circle']
      }
    },
    iconClass() {
      switch (this.type) {
        case 'success': return 'text-olive-green'
        case 'error': return 'text-burgundy-red'
        case 'warning': return 'text-orange-warm'
        default: return 'text-gray-dark'
      }
    }
  }
}
</script>
