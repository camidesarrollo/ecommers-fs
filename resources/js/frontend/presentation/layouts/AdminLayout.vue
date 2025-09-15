<!-- layouts/AdminLayout.vue -->
<template>
  <div class="bg-gray-100 min-h-screen">
    <HeaderAdmin />
    <aside>Sidebar Admin</aside>
    <main><slot /></main>
  </div>
</template>
<script>
import HeaderAdmin from '../components/HeaderAdmin.vue';
export default { components: { HeaderAdmin } };
</script>
