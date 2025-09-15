<!-- layouts/PublicLayout.vue -->
<template>
  <div class="bg-yellow-100 min-h-screen">
    <HeaderPublic />
    <main><slot /></main>
    <FooterPublic />
  </div>
</template>
<script>
import HeaderPublic from '../components/Header.vue';
import FooterPublic from '../components/Footer.vue';
export default { components: { HeaderPublic, FooterPublic } };
</script>
