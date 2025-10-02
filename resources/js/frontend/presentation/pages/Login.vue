<template>
  <div class="min-h-screen bg-pattern relative overflow-hidden">

    <!-- Decorative floating nuts -->
    <div v-for="(nut, index) in floatingNuts" :key="index" class="nut-decoration"
      :style="{ left: nut.left, animationDelay: nut.delay }">
      {{ nut.emoji }}
    </div>

    <!-- Background gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-beige via-transparent to-mint-green opacity-30"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
      <div class="w-full max-w-md">

        <!-- Logo y título -->
        <div class="text-center mb-8 slide-in">
          <div class="inline-flex items-center gap-3 mb-4">
            <div class="w-16 h-16 rounded-full bg-gradient-nuts flex items-center justify-center floating pulse-warm">
              <font-awesome-icon :icon="['fas', 'seedling']" class="text-2xl text-white" />
            </div>
          </div>
          <h1 class="text-3xl font-bold text-dark-chocolate mb-2">¡Bienvenido de vuelta!</h1>
          <p class="text-gray-dark">Ingresa a tu cuenta de Secos y Saludables JPJ</p>
        </div>

        <!-- Formulario de login -->
        <div class="glass-effect rounded-2xl p-8 shadow-2xl slide-in delay-200">
          <form @submit.prevent="handleLogin" class="space-y-6">

            <!-- Campo Email -->
            <div class="space-y-2">
              <label for="email" class="block text-sm font-semibold text-dark-chocolate">
                <font-awesome-icon :icon="['fas', 'envelope']" class="text-olive-green mr-2" />
                Correo Electrónico
              </label>
              <input v-model="form.email" type="email" id="email" required :class="[
                'w-full px-4 py-3 rounded-lg input-focus bg-white text-dark-chocolate placeholder-gray-400',
                errors.email ? 'border-burgundy-red' : ''
              ]" placeholder="tu@email.com" @blur="validateEmail">
              <p v-if="errors.email" class="text-burgundy-red text-sm mt-1">
                <font-awesome-icon :icon="['fas', 'exclamation-circle']" class="mr-1" />
                {{ errors.email }}
              </p>
            </div>

            <!-- Campo Password -->
            <div class="space-y-2">
              <label for="password" class="block text-sm font-semibold text-dark-chocolate">
                <font-awesome-icon :icon="['fas', 'lock']" class="text-olive-green mr-2" />
                Contraseña
              </label>
              <div class="relative">
                <input v-model="form.password" :type="showPassword ? 'text' : 'password'" id="password" required :class="[
                  'w-full px-4 py-3 rounded-lg input-focus bg-white text-dark-chocolate placeholder-gray-400 pr-12',
                  errors.password ? 'border-burgundy-red' : ''
                ]" placeholder="••••••••" @blur="validatePassword">
                <button type="button" @click="togglePassword"
                  class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-dark hover:text-olive-green transition-colors">
                  <font-awesome-icon :icon="['fas', showPassword ? 'eye-slash' : 'eye']" />
                </button>
              </div>
              <p v-if="errors.password" class="text-burgundy-red text-sm mt-1">
                <font-awesome-icon :icon="['fas', 'exclamation-circle']" class="mr-1" />
                {{ errors.password }}
              </p>
            </div>

            <!-- Recordar y Olvidé contraseña -->
            <div class="flex items-center justify-between">
              <label class="flex items-center cursor-pointer">
                <input v-model="form.remember" type="checkbox"
                  class="w-4 h-4 rounded border-2 border-gray-300 text-olive-green focus:ring-olive-green">
                <span class="ml-2 text-sm text-gray-dark">Recordarme</span>
              </label>
              <router-link to="/forgot-password"
                class="text-sm text-olive-green hover:text-nut-brown transition-colors">
                ¿Olvidaste tu contraseña?
              </router-link>
            </div>

            <!-- Botón de login -->
            <UiButtons tipo="agregar" :accion="handleLogin" :label="isLoading ? 'Ingresando...' : 'Iniciar Sesión'"
              class="w-full flex items-center justify-center">
              <template v-if="!isLoading">
                <font-awesome-icon :icon="['fas', 'sign-in-alt']" class="mr-2" />
              </template>
              <template v-else>
                <font-awesome-icon :icon="['fas', 'spinner']" class="mr-2 fa-spin" />
              </template>
            </UiButtons>
          </form>

          <!-- Separador -->
          <div class="my-6 flex items-center">
            <div class="flex-1 border-t border-gray-300"></div>
            <span class="px-4 text-sm text-gray-dark bg-white rounded-full">O continúa con</span>
            <div class="flex-1 border-t border-gray-300"></div>
          </div>

          <!-- Login social -->
          <div class="grid grid-cols-2 gap-3">
            <button @click="loginWithGoogle"
              class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
              <font-awesome-icon :icon="['fab', 'google']" class="text-burgundy-red mr-2" />
              <span class="text-sm text-dark-chocolate">Google</span>
            </button>
            <button @click="loginWithFacebook"
              class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
              <font-awesome-icon :icon="['fab', 'facebook-f']" class="text-blue-600 mr-2" />
              <span class="text-sm text-dark-chocolate">Facebook</span>
            </button>
          </div>

          <!-- Registro -->
          <div class="mt-8 text-center">
            <p class="text-gray-dark">
              ¿No tienes una cuenta?
              <router-link to="/register" class="text-olive-green hover:text-nut-brown font-semibold transition-colors">
                Regístrate aquí
              </router-link>
            </p>
          </div>
        </div>

        <!-- Enlaces adicionales -->
        <div class="text-center mt-6 slide-in delay-400">
          <router-link to="/" class="inline-flex items-center text-gray-dark hover:text-olive-green transition-colors">
            <font-awesome-icon :icon="['fas', 'arrow-left']" class="mr-2" />
            Volver a la tienda
          </router-link>
        </div>
      </div>
    </div>

    <!-- Toast de notificación -->
    <Transition name="toast" appear>
      <div v-if="toast.show" class="fixed top-4 right-4 z-50 max-w-sm">
        <div class="bg-white border-l-4 rounded-lg shadow-lg p-4" :class="toastBorderClass">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <font-awesome-icon :icon="toastIcon" :class="toastIconClass" />
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium text-dark-chocolate">
                {{ toast.message }}
              </p>
            </div>
            <button @click="hideToast" class="ml-auto text-gray-400 hover:text-gray-600">
              <font-awesome-icon :icon="['fas', 'times']" />
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script>
import { ref, reactive, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import {
  faEnvelope,
  faLock,
  faSignInAlt,
  faSpinner,
  faEye,
  faEyeSlash,
  faArrowLeft,
  faCheckCircle,
  faExclamationCircle,
  faTimes,
  faSeedling
} from '@fortawesome/free-solid-svg-icons'
import { faGoogle, faFacebookF } from '@fortawesome/free-brands-svg-icons'
import UiButtons from '../components/Buttons/UiButtons.vue';

// Agregar iconos a la librería
library.add(
  faEnvelope,
  faLock,
  faSignInAlt,
  faSpinner,
  faEye,
  faEyeSlash,
  faArrowLeft,
  faCheckCircle,
  faExclamationCircle,
  faTimes,
  faSeedling,
  faGoogle,
  faFacebookF
)

export default {
  name: 'LoginPage',
  components: {
    FontAwesomeIcon,
    UiButtons
  },
  setup() {
    const router = useRouter()

    // Estado del formulario
    const form = reactive({
      email: '',
      password: '',
      remember: false
    })

    // Estado de errores
    const errors = reactive({
      email: '',
      password: ''
    })

    // Estados de la UI
    const isLoading = ref(false)
    const showPassword = ref(false)

    // Toast notifications
    const toast = reactive({
      show: false,
      message: '',
      type: 'success' // success, error, warning
    })

    // Nueces flotantes decorativas
    const floatingNuts = ref([
      { emoji: '🥜', left: '10%', delay: '0s' },
      { emoji: '🌰', left: '20%', delay: '1s' },
      { emoji: '🥥', left: '30%', delay: '2s' },
      { emoji: '🫒', left: '70%', delay: '3s' },
      { emoji: '🌰', left: '80%', delay: '4s' },
      { emoji: '🥜', left: '90%', delay: '5s' }
    ])

    // Computed properties
    const isFormValid = computed(() => {
      return form.email &&
        form.password &&
        !errors.email &&
        !errors.password &&
        isValidEmail(form.email)
    })

    const toastBorderClass = computed(() => {
      return toast.type === 'error' ? 'border-burgundy-red' : 'border-olive-green'
    })

    const toastIcon = computed(() => {
      return toast.type === 'error' ? ['fas', 'exclamation-circle'] : ['fas', 'check-circle']
    })

    const toastIconClass = computed(() => {
      return toast.type === 'error' ? 'text-burgundy-red' : 'text-olive-green'
    })

    // Methods
    const isValidEmail = (email) => {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      return emailRegex.test(email)
    }

    const validateEmail = () => {
      if (!form.email) {
        errors.email = 'El email es requerido'
      } else if (!isValidEmail(form.email)) {
        errors.email = 'Por favor ingresa un email válido'
      } else {
        errors.email = ''
      }
    }

    const validatePassword = () => {
      if (!form.password) {
        errors.password = 'La contraseña es requerida'
      } else if (form.password.length < 6) {
        errors.password = 'La contraseña debe tener al menos 6 caracteres'
      } else {
        errors.password = ''
      }
    }

    const togglePassword = () => {
      showPassword.value = !showPassword.value
    }

    const showToast = (message, type = 'success') => {
      toast.message = message
      toast.type = type
      toast.show = true

      setTimeout(() => {
        hideToast()
      }, 5000)
    }

    const hideToast = () => {
      toast.show = false
    }

    const handleLogin = async () => {
      // Validar formulario
      validateEmail()
      validatePassword()

      if (!isFormValid.value) {
        showToast('Por favor corrige los errores en el formulario', 'error')
        return
      }

      isLoading.value = true

      try {
        // Simular llamada a API
        await new Promise(resolve => setTimeout(resolve, 2000))

        // Validación demo (reemplazar con tu lógica de autenticación)
        if (form.email === 'demo@test.com' && form.password === '123456') {
          showToast('¡Bienvenido de vuelta! Redirigiendo...', 'success')

          // Simular guardado de token/sesión
          if (form.remember) {
            localStorage.setItem('remember_user', 'true')
          }

          setTimeout(() => {
            router.push('/dashboard') // o tu ruta principal
          }, 2000)
        } else {
          showToast('Credenciales incorrectas. Intenta con demo@test.com / 123456', 'error')
        }
      } catch (error) {
        showToast('Error al iniciar sesión. Intenta nuevamente.', 'error')
        console.error('Login error:', error)
      } finally {
        isLoading.value = false
      }
    }

    const loginWithGoogle = async () => {
      showToast('Funcionalidad de Google en desarrollo', 'warning')
      // Implementar lógica de Google OAuth
    }

    const loginWithFacebook = async () => {
      showToast('Funcionalidad de Facebook en desarrollo', 'warning')
      // Implementar lógica de Facebook OAuth
    }

    // Lifecycle
    onMounted(() => {
      // Auto-rellenar para demo
      setTimeout(() => {
        showToast('💡 Tip: Usa demo@test.com / 123456 para probar', 'success')
      }, 1000)
    })

    return {
      form,
      errors,
      isLoading,
      showPassword,
      toast,
      floatingNuts,
      isFormValid,
      toastBorderClass,
      toastIcon,
      toastIconClass,
      validateEmail,
      validatePassword,
      togglePassword,
      showToast,
      hideToast,
      handleLogin,
      loginWithGoogle,
      loginWithFacebook
    }
  }
}
</script>
