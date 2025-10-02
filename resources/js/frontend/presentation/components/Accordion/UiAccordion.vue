<template>
  <div class="accordion-container">
    <div
      v-for="(item, index) in items"
      :key="index"
      class="border-2 rounded-lg overflow-hidden mb-4 bg-white shadow-md hover:shadow-lg transition-shadow"
      :class="getBorderClass(item.color)">
      
      <!-- Header -->
      <button
        @click="toggleItem(index)"
        class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
        <div class="flex items-center gap-3">
          <span v-if="item.icon" class="text-2xl">{{ item.icon }}</span>
          <h3 class="text-lg font-bold text-dark-chocolate text-left">
            {{ item.title }}
          </h3>
        </div>
        <svg
          class="w-6 h-6 transition-transform text-gray-dark"
          :class="{ 'rotate-180': isOpen(index) }"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <!-- Content -->
      <transition name="accordion">
        <div
          v-show="isOpen(index)"
          class="px-6 py-4 border-t-2"
          :class="getBorderClass(item.color)">
          <div class="text-gray-dark">
            <slot :name="`item-${index}`" :item="item">
              <div v-html="item.content"></div>
            </slot>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UiAccordion',
  
  props: {
    items: {
      type: Array,
      required: true,
      validator: (items) => {
        return items.every(item => item.title);
      }
    },
    multiple: {
      type: Boolean,
      default: false
    },
    defaultOpen: {
      type: [Number, Array],
      default: null
    }
  },

  data() {
    return {
      openItems: []
    };
  },

  created() {
    this.initializeOpenItems();
  },

  methods: {
    initializeOpenItems() {
      if (this.defaultOpen !== null) {
        if (Array.isArray(this.defaultOpen)) {
          this.openItems = [...this.defaultOpen];
        } else {
          this.openItems = [this.defaultOpen];
        }
      }
    },

    toggleItem(index) {
      if (this.multiple) {
        const itemIndex = this.openItems.indexOf(index);
        if (itemIndex > -1) {
          this.openItems.splice(itemIndex, 1);
        } else {
          this.openItems.push(index);
        }
      } else {
        if (this.openItems.includes(index)) {
          this.openItems = [];
        } else {
          this.openItems = [index];
        }
      }
      
      this.$emit('toggle', {
        index,
        isOpen: this.isOpen(index),
        item: this.items[index]
      });
    },

    isOpen(index) {
      return this.openItems.includes(index);
    },

    getBorderClass(color) {
      const colorMap = {
        'olive-green': 'border-olive-green',
        'nut-brown': 'border-nut-brown',
        'golden-yellow': 'border-golden-yellow',
        'burgundy-red': 'border-burgundy-red'
      };
      return colorMap[color] || 'border-olive-green';
    }
  }
};
</script>

<style scoped>
.accordion-enter-active,
.accordion-leave-active {
  transition: all 0.3s ease;
  overflow: hidden;
}

.accordion-enter-from,
.accordion-leave-to {
  max-height: 0;
  opacity: 0;
}

.accordion-enter-to,
.accordion-leave-from {
  max-height: 500px;
  opacity: 1;
}

.rotate-180 {
  transform: rotate(180deg);
}

/* Clases de borde personalizadas */
.border-olive-green {
  border-color: var(--color-olive-green);
}

.border-nut-brown {
  border-color: var(--color-nut-brown);
}

.border-golden-yellow {
  border-color: var(--color-golden-yellow);
}

.border-burgundy-red {
  border-color: var(--color-burgundy-red);
}
</style>
<!-- EJEMPLO DE USO 
 
<template>
  <UiAccordion 
    :items="accordionItems" 
    :multiple="true"
    :default-open="[0]"
    @toggle="handleToggle">
    
    <template #item-1="{ item }">
      <p>Contenido personalizado para: {{ item.title }}</p>
    </template>
  </UiAccordion>
</template>

<script>
import UiAccordion from '@/components/UiAccordion.vue';

export default {
  components: {
    UiAccordion
  },
  
  data() {
    return {
      accordionItems: [
        {
          title: 'Información de Almendras',
          icon: '🌰',
          color: 'nut-brown',
          content: '<p>Las almendras son ricas en vitamina E...</p>'
        },
        {
          title: 'Beneficios de las Nueces',
          icon: '🥜',
          color: 'golden-yellow',
          content: '<ul><li>Alto contenido de omega-3</li></ul>'
        }
      ]
    };
  },
  
  methods: {
    handleToggle(event) {
      console.log('Toggle:', event);
    }
  }
};
</script>

-->