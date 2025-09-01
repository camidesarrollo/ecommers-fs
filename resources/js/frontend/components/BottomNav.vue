<template>
  <nav class="fixed bottom-0 w-full bg-white shadow-t border-t">
    <div class="flex justify-around">
      <NavItem :icon="['fas','house']" label="Inicio" :active="active==='home'" @click="$emit('update:active','home')" />
      <NavItem :icon="['fas','th']" label="Categorías" :active="active==='categories'" @click="$emit('update:active','categories')" />
      <NavItem :icon="['fas','heart']" label="Favoritos" :active="active==='favorites'" @click="$emit('update:active','favorites')" />
      <NavItem :icon="['fas','user']" label="Perfil" :active="active==='profile'" @click="$emit('update:active','profile')" />
    </div>
  </nav>
</template>

<script>
import NavItem from './NavItem.vue';

export default {
  components: { NavItem },
  props: { active: String },
};
</script>

<style scoped>
/* Sombra superior */
.shadow-t {
  box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
}
</style>
