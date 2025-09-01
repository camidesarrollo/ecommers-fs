<template>
    <footer class="bg-gray-50 text-gray-800 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Sección: Sucursales -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">SUCURSALES</h3>
                    <ul class="space-y-2 text-sm">
                        <li v-for="(sucursal, index) in sucursales" :key="index">
                            {{ sucursal }}
                        </li>
                    </ul>
                </div>

                <!-- Sección: Navegación -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">ENLACES</h3>
                    <ul class="space-y-2 text-sm">
                        <li v-for="(enlace, index) in enlaces" :key="index">
                            <a :href="enlace.url" class="hover:text-blue-500 transition">
                                {{ enlace.text }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Sección: Contacto / Logo -->
                <div class="flex flex-col items-start md:items-end">
                    <!-- Logo -->
                    <!-- <img :src="logo" alt="Logo" class="mb-4 w-32 md:w-40 object-contain"> -->
                    <div class="flex items-center gap-3">
                        <div
                            class="rounded-full p-2 bg-gradient-to-br from-yellow-700 to-yellow-500 text-white text-xl animate-bounce">
                            🥜
                        </div>
                        <span class="font-bold text-xl text-gray-800">NutsMart</span>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex items-center space-x-2 mb-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.149-.672.15-.198.297-.767.967-.94 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.173.198-.297.297-.495.099-.198.05-.372-.025-.521-.074-.149-.672-1.611-.92-2.207-.242-.579-.487-.501-.672-.51-.173-.007-.372-.008-.571-.008-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.29.173-1.413-.074-.124-.272-.198-.571-.347z" />
                        </svg>
                        <span>{{ telefono }}</span>
                    </div>

                    <!-- Email -->
                    <div class="text-sm mb-4">{{ email }}</div>

                    <!-- Redes sociales -->
                    <div class="flex space-x-4">
                        <a v-for="(red, index) in redes" :key="index" :href="red.url" target="_blank"
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                            <font-awesome-icon :icon="red.icon" class="w-5 h-5 text-gray-600 hover:text-blue-600" />
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer bottom -->
            <div class="mt-8 border-t border-gray-200 pt-4 text-center text-xs text-gray-500">
                © {{ new Date().getFullYear() }} {{ empresa }}. Todos los derechos reservados.
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref } from "vue"
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome"
import { faFacebook, faInstagram, faTiktok } from "@fortawesome/free-brands-svg-icons"

const empresa = ref("Nuts")
const logo = ref("/assets/logo.png")
const telefono = ref("+56 9 51108675")
const email = ref("comercializadora@Nuts.cl")

const sucursales = ref([
    "Av Grecia 2929 - Ñuñoa",
    //   "Av. Concha y Toro 3972, Local 4 - Puente Alto",
    //   "Monumento 1750 Local B - Maipú",
    //   "Manuel Montt 2129 - Providencia"
])

const enlaces = ref([
    { text: "Frutos secos por mayor", url: "#" },
    { text: "Preguntas Frecuentes", url: "#" },
    { text: "Política de devoluciones y reembolsos", url: "#" },
    { text: "Quiénes Somos", url: "#" },
    { text: "Contacto", url: "#" }
])

// Redes sociales con FontAwesome
const redes = ref([
    { icon: faFacebook, url: "https://facebook.com" },
    { icon: faInstagram, url: "https://instagram.com" },
    { icon: faTiktok, url: "https://tiktok.com" }
])
</script>
