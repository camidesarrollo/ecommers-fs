<template>
  <nav class="fixed bottom-0 w-full bg-white shadow-t border-t">
    <div class="flex justify-around">
      <NavItem to="/" :icon="['house']" label="Inicio" :active="active === 'home'" @update:active="updateActive" />
      <NavItem to="/productoList" :icon="['th']" label="Productos" :active="active === 'productoList'"
        @update:active="updateActive" />
      <NavItem to="/favorites" :icon="['heart']" label="Favoritos" :active="active === 'favorites'"
        @update:active="updateActive" />
      <NavItem to="/profile" :icon="['user']" label="Perfil" :active="active === 'profile'"
        @update:active="updateActive" />

    </div>
  </nav>
</template>

<script>
import NavItem from './NavItem.vue';

export default {
  components: { NavItem },
  props: { active: String },
  methods: {
    updateActive(tab) {
      this.$emit('update:active', tab);
    }
  }
};
</script>

<style scoped>
.shadow-t {
  box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
}
</style>
