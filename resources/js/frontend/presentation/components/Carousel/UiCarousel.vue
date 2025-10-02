<template>
  <div class="relative w-full overflow-hidden" :class="containerClasses">
    <!-- Carousel Track -->
    <div
      ref="track"
      class="flex transition-transform duration-500 ease-out"
      :style="trackStyle"
      @touchstart="handleTouchStart"
      @touchmove="handleTouchMove"
      @touchend="handleTouchEnd"
    >
      <div
        v-for="(item, index) in items"
        :key="index"
        class="flex-shrink-0 px-2"
        :style="slideStyle"
      >
        <slot name="item" :item="item" :index="index">
          <div class="bg-beige rounded-lg p-6 h-full shadow-lg">
            {{ item }}
          </div>
        </slot>
      </div>
    </div>

    <!-- Navigation Arrows -->
    <button
      v-if="showArrows && !isStart"
      @click="prev"
      class="absolute left-2 top-1/2 -translate-y-1/2 bg-olive-green hover:bg-olive-green-dark text-white rounded-full p-3 shadow-lg transition-all duration-300 z-10 hover:scale-110"
      :class="{ 'opacity-50 cursor-not-allowed': isStart }"
      :disabled="isStart"
      aria-label="Anterior"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <button
      v-if="showArrows && !isEnd"
      @click="next"
      class="absolute right-2 top-1/2 -translate-y-1/2 bg-olive-green hover:bg-olive-green-dark text-white rounded-full p-3 shadow-lg transition-all duration-300 z-10 hover:scale-110"
      :class="{ 'opacity-50 cursor-not-allowed': isEnd }"
      :disabled="isEnd"
      aria-label="Siguiente"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </button>

    <!-- Dots Pagination -->
    <div
      v-if="showDots"
      class="flex justify-center items-center gap-2 mt-6"
    >
      <button
        v-for="(dot, index) in totalPages"
        :key="index"
        @click="goToPage(index)"
        class="transition-all duration-300 rounded-full"
        :class="[
          currentPage === index 
            ? 'bg-olive-green w-8 h-3' 
            : 'bg-gray-light hover:bg-gray-light-dark w-3 h-3'
        ]"
        :aria-label="`Ir a página ${index + 1}`"
      />
    </div>

    <!-- Progress Bar -->
    <div
      v-if="showProgress"
      class="w-full bg-gray-light h-1 rounded-full mt-4 overflow-hidden"
    >
      <div
        class="bg-olive-green h-full transition-all duration-500 ease-out"
        :style="{ width: `${progress}%` }"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
  items: {
    type: Array,
    required: true
  },
  slidesToShow: {
    type: Number,
    default: 1
  },
  slidesToScroll: {
    type: Number,
    default: 1
  },
  autoplay: {
    type: Boolean,
    default: false
  },
  autoplaySpeed: {
    type: Number,
    default: 3000
  },
  infinite: {
    type: Boolean,
    default: false
  },
  showArrows: {
    type: Boolean,
    default: true
  },
  showDots: {
    type: Boolean,
    default: true
  },
  showProgress: {
    type: Boolean,
    default: false
  },
  gap: {
    type: Number,
    default: 16
  },
  containerClasses: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['change', 'slideChange']);

const track = ref(null);
const currentPage = ref(0);
const touchStartX = ref(0);
const touchEndX = ref(0);
let autoplayInterval = null;

const totalPages = computed(() => {
  return Math.ceil(props.items.length / props.slidesToScroll);
});

const currentSlide = computed(() => {
  return currentPage.value * props.slidesToScroll;
});

const isStart = computed(() => {
  return currentPage.value === 0;
});

const isEnd = computed(() => {
  return currentPage.value >= totalPages.value - 1;
});

const progress = computed(() => {
  return ((currentPage.value + 1) / totalPages.value) * 100;
});

const trackStyle = computed(() => {
  const translateX = -(currentSlide.value * (100 / props.slidesToShow));
  return {
    transform: `translateX(${translateX}%)`
  };
});

const slideStyle = computed(() => {
  return {
    width: `${100 / props.slidesToShow}%`
  };
});

const next = () => {
  if (isEnd.value && !props.infinite) return;
  
  if (isEnd.value && props.infinite) {
    currentPage.value = 0;
  } else {
    currentPage.value++;
  }
  
  emit('change', currentPage.value);
  emit('slideChange', currentSlide.value);
};

const prev = () => {
  if (isStart.value && !props.infinite) return;
  
  if (isStart.value && props.infinite) {
    currentPage.value = totalPages.value - 1;
  } else {
    currentPage.value--;
  }
  
  emit('change', currentPage.value);
  emit('slideChange', currentSlide.value);
};

const goToPage = (page) => {
  currentPage.value = page;
  emit('change', currentPage.value);
  emit('slideChange', currentSlide.value);
};

const handleTouchStart = (e) => {
  touchStartX.value = e.touches[0].clientX;
};

const handleTouchMove = (e) => {
  touchEndX.value = e.touches[0].clientX;
};

const handleTouchEnd = () => {
  const diff = touchStartX.value - touchEndX.value;
  const threshold = 50;

  if (Math.abs(diff) > threshold) {
    if (diff > 0) {
      next();
    } else {
      prev();
    }
  }

  touchStartX.value = 0;
  touchEndX.value = 0;
};

const startAutoplay = () => {
  if (!props.autoplay) return;
  
  autoplayInterval = setInterval(() => {
    next();
  }, props.autoplaySpeed);
};

const stopAutoplay = () => {
  if (autoplayInterval) {
    clearInterval(autoplayInterval);
    autoplayInterval = null;
  }
};

watch(() => props.autoplay, (newVal) => {
  if (newVal) {
    startAutoplay();
  } else {
    stopAutoplay();
  }
});

onMounted(() => {
  if (props.autoplay) {
    startAutoplay();
  }
});

onUnmounted(() => {
  stopAutoplay();
});

defineExpose({
  next,
  prev,
  goToPage,
  currentPage,
  currentSlide
});
</script>

<style scoped>
/* Custom scrollbar if needed */
::-webkit-scrollbar {
  display: none;
}

/* Smooth transitions */
.transition-transform {
  will-change: transform;
}
</style>

<!-- 

<UiCarousel
  :items="productos"
  :slides-to-show="3"
  :autoplay="true"
  :autoplay-speed="4000"
  show-arrows
  show-dots
  show-progress
>
  <template #item="{ item, index }">
    <div class="bg-beige rounded-lg p-6 shadow-lg">
      <img :src="item.imagen" :alt="item.nombre" class="w-full rounded-lg mb-4">
      <h3 class="text-nut-brown font-bold text-xl">{{ item.nombre }}</h3>
      <p class="text-gray-dark mt-2">{{ item.precio }}</p>
    </div>
  </template>
</UiCarousel>

-->