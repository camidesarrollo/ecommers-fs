<template>
    <BannerProductos />


    <!-- Products Offer -->
    <ProductosOferta />

    <section class="py-12 text-white bg-gradient-to-tr from-indigo-500 to-purple-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Tarjeta 1 -->
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <img src="/public/img/icons8-en-tránsito.gif" alt="" class="w-10 h-10" />
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">
                        DESPACHO GRATIS EN R. METROPOLITANA
                    </h3>
                    <p class="text-gray-600 text-sm">Por compras desde $100.000 + IVA</p>
                </div>

                <!-- Tarjeta 2 -->
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <img src="/public/img/icons8-garantía.gif" alt="" class="w-10 h-10" />
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">PRODUCTOS DE CALIDAD</h3>
                    <p class="text-gray-600 text-sm">Con altos estándares de exigencia y selección</p>
                </div>

                <!-- Tarjeta 3 -->
                <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <img src="/public/img/icons8-terminal-punto-de-venta.gif" alt="" class="w-10 h-10" />
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">PAGO SEGURO</h3>
                    <p class="text-gray-600 text-sm">
                        Aceptamos tarjetas de débito y crédito de forma segura
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- Featured Products -->
    <ProductosDestacados />

    <!-- Categories -->
    <!-- <section class="py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Categorías</h2>
            <div class="grid grid-cols-2 gap-4">
                <CategoryPill name="Almendras" emoji="🥜" bgClass="bg-gradient-to-br from-yellow-400 to-yellow-500" />
                <CategoryPill name="Nueces" emoji="🌰" bgClass="bg-gradient-to-br from-yellow-300 to-yellow-400" />
                <CategoryPill name="Pistachos" emoji="🥨" bgClass="bg-gradient-to-br from-green-400 to-green-500" />
                <CategoryPill name="Mix Premium" emoji="🥜" bgClass="bg-gradient-to-br from-pink-400 to-pink-500" />
            </div>
        </div>
    </section> -->

    <section class="py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <SpecialOffer title="¡Oferta Especial!" subtitle="Compra 3 productos y llévate el 4to GRATIS"
                buttonText="Aprovechar Oferta" />
        </div>
    </section>

    <Category />

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
import ProductosOferta from '../components/ProductosOferta.vue';
import Footer from '../components/Footer.vue';
import BannerProductos from '../components/BannerProductos.vue';
import Category from '../components/Category/Category.uc.vue';

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
        ProductosOferta,
        Footer,
        BannerProductos,
        Category
    },
    data() {
        return {
            activeNav: 'home'
        };
    }
};
</script>




<style scoped></style>
