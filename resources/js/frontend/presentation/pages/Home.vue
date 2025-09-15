<template>
    <BannerProductos />

   <Servicios />

    <Category />


    <!-- Products Offer -->
    <ProductosOferta />

    <ProductosEstrella />

    <!-- Featured Products -->
    <ProductosDestacados />

    <ProductosRecientes />

    <RecetasIdeas />

    <OpinionesClientes />

    <PacksSuscripciones />

    <PropiedadesNutricionales />

    <Gif />

    <Newsletter />


    <!-- 
    <section class="py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <SpecialOffer title="¡Oferta Especial!" subtitle="Compra 3 productos y llévate el 4to GRATIS"
                buttonText="Aprovechar Oferta" />
        </div>
    </section>
 -->



    <!-- Hero -->
    <!-- <section class="relative overflow-hidden py-20 text-white bg-gradient-to-tr from-indigo-500 to-purple-700">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute animate-float" style="top: 60px; left: 40px; font-size: 5rem;">🌰</div>
            <div class="absolute animate-float animate-float-delay-1" style="top: 150px; right: 30px; font-size: 4rem;">
                🥜
            </div>
            <div class="absolute animate-float animate-float-delay-2"
                style="bottom: 80px; left: 20px; font-size: 3rem;">
                🌰</div>
        </div>
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 hero-text">Frutos Secos Premium</h1>
            <p class="text-xl md:text-2xl mb-8 hero-text opacity-90">Naturales, frescos y llenos de sabor</p>
            <button
                class="bg-gradient-to-r from-pink-500 to-yellow-400 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:brightness-110 transition">
                Explorar Productos
            </button>
        </div>
    </section> -->



    <!-- Special Offer -->
    <!-- <section class="py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <SpecialOffer title="¡Oferta Especial!" subtitle="Compra 3 productos y llévate el 4to GRATIS"
                buttonText="Aprovechar Oferta" />
        </div>
    </section> -->
</template>

<script>
import Button from '../components/Button.vue';
import ProductCard from '../components/ProductCard.vue';
import CategoryPill from '../components/CategoryPill.vue';
import SpecialOffer from '../components/SpecialOffer.vue';
import Header from '../components/Header.vue';
import BottomNav from '../components/BottomNav.vue';
import ProductosDestacados from '../components/ProductosDestacados.vue';
import ProductosRecientes from '../components/ProductosRecientes.vue';
import ProductosOferta from '../components/ProductosOferta.vue';
import Footer from '../components/Footer.vue';
import BannerProductos from '../components/BannerProductos.vue';
import Category from '../components/Category.vue';
import ProductosEstrella from '../components/ProductosEstrella.vue';
import RecetasIdeas from '../components/BannerRecetasIdeas.vue';
import OpinionesClientes from '../components/OpinionesClientes.vue';
import PacksSuscripciones from '../components/PacksSuscripciones.vue';
import PropiedadesNutricionales from '../components/PropiedadesNutricionales.vue';
import Gif from '../components/Gif.vue';
import Newsletter from '../components/Newsletter.vue';
import Servicios from '../components/Servicios.vue';
export default {
    name: "Home",
    components: {
        Button,
        ProductCard,
        CategoryPill,
        SpecialOffer,
        Header,
        BottomNav,
        ProductosDestacados,
        ProductosRecientes,
        ProductosOferta,
        Footer,
        BannerProductos,
        Category,
        ProductosEstrella,
        RecetasIdeas,
        OpinionesClientes,
        PacksSuscripciones,
        PropiedadesNutricionales,
        Gif,
        Newsletter,
        Servicios
    },
    data() {
        return {
            activeNav: 'home'
        };
    }
};
</script>




<style scoped></style>
