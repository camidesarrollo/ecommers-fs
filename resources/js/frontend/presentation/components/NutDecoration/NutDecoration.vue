<template>
  <div class="nut-decoration-container">
    <div
      v-for="(nut, index) in nuts"
      :key="index"
      class="nut-decoration"
      :style="{
        left: nut.left,
        animationDelay: nut.delay,
        animationDuration: nut.duration,
        fontSize: size,
        opacity: opacity
      }"
    >
      {{ nut.emoji }}
    </div>
  </div>
</template>

<script>
import { computed } from 'vue'

export default {
  name: 'NutDecoration',
  props: {
    // Cantidad de frutos secos a mostrar
    count: {
      type: Number,
      default: 6
    },
    // Tamaño de los emojis
    size: {
      type: String,
      default: '2rem'
    },
    // Opacidad de los elementos
    opacity: {
      type: Number,
      default: 0.6
    },
    // Tipos de frutos secos a usar
    nutTypes: {
      type: Array,
      default: () => ['🥜', '🌰', '🥥']
    }
  },
  setup(props) {
    const nuts = computed(() => {
      const result = []
      const spacing = 100 / (props.count + 1)
      
      for (let i = 0; i < props.count; i++) {
        result.push({
          emoji: props.nutTypes[i % props.nutTypes.length],
          left: `${(i + 1) * spacing}%`,
          delay: `${i * 2}s`,
          duration: `${8 + Math.random() * 4}s` // Duración variable entre 8-12s
        })
      }
      
      return result
    })

    return {
      nuts
    }
  }
}
</script>

<style scoped>
.nut-decoration-container {
  position: absolute;
  inset: 0;
  pointer-events: none;
  overflow: hidden;
}

.nut-decoration {
  position: absolute;
  bottom: -100px;
  animation: floatUpDiagonal infinite ease-in-out;
  pointer-events: none;
  user-select: none;
}

@keyframes floatUpDiagonal {
  0% {
    transform: translateY(0) translateX(0) rotate(0deg);
    opacity: 0;
  }
  10% {
    opacity: 0.6;
  }
  90% {
    opacity: 0.6;
  }
  100% {
    transform: translateY(-110vh) translateX(50px) rotate(360deg);
    opacity: 0;
  }
}
</style>