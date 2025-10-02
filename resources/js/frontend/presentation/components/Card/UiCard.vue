<template>
  <div
    class="max-w-md rounded-2xl shadow-nut-brown/30 hover:shadow-olive-green/30 transition transform hover:-translate-y-1 bg-white glass-effect overflow-hidden"
  >
    <!-- Header -->
    <div
      v-if="title || subtitle"
      :class="headerClass"
      class="p-4"
    >
      <h2 v-if="title" class="text-xl font-bold text-white drop-shadow-lg">
        {{ title }}
      </h2>
      <p v-if="subtitle" class="text-beige-dark text-sm">
        {{ subtitle }}
      </p>
    </div>

    <!-- Body -->
    <div class="p-4 text-dark-chocolate">
      <slot>
        <p class="text-gray-dark">
          Contenido de ejemplo: reemplázame con lo que necesites.
        </p>
      </slot>
    </div>

    <!-- Footer / Actions -->
    <div
      v-if="actions.length"
      class="flex justify-end gap-3 p-4 border-t border-gray-light-dark"
    >
      <button
        v-for="(action, i) in actions"
        :key="i"
        :class="action.class"
        @click="action.onClick"
      >
        <span v-if="action.icon" class="mr-1">{{ action.icon }}</span>
        {{ action.label }}
      </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: { type: String, default: "" },
  subtitle: { type: String, default: "" },
  headerClass: {
    type: String,
    default: "bg-gradient-to-br from-olive-green to-mint-green",
  },
  actions: {
    type: Array,
    default: () => [],
    // Ejemplo:
    // [
    //   { label: "Añadir", icon: "➕", class: "btn-add", onClick: () => {} },
    //   { label: "Editar", icon: "✏️", class: "btn-edit", onClick: () => {} },
    //   { label: "Eliminar", icon: "🗑️", class: "btn-delete", onClick: () => {} },
    // ]
  },
});
</script>
<!-- 
USO DE EJEMPLO

<template>
  <UiCard
    title="Producto Saludable"
    subtitle="Frutos secos y semillas"
    :actions="cardActions"
  >
    <p>
      Descubre nuestra selección de frutos secos, chocolates y especias de la
      mejor calidad. Productos naturales y frescos para tu bienestar.
    </p>
  </UiCard>
</template>

<script setup>
import UiCard from "@/components/UiCard.vue";

const cardActions = [
  {
    label: "Añadir",
    icon: "➕",
    class: "btn-add",
    onClick: () => alert("Añadir clic"),
  },
  {
    label: "Editar",
    icon: "✏️",
    class: "btn-edit",
    onClick: () => alert("Editar clic"),
  },
  {
    label: "Eliminar",
    icon: "🗑️",
    class: "btn-delete",
    onClick: () => alert("Eliminar clic"),
  },
];
</script>

-->