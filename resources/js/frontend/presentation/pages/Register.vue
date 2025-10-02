<template>
  <div class="min-h-screen bg-pattern relative overflow-hidden">
    <!-- Componente de decoración de frutos secos -->
    <NutDecoration />

    <!-- Background gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-beige via-transparent to-mint-green opacity-30"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4 py-12">
      <div class="w-full max-w-2xl">
        <!-- Logo y título -->
        <div class="text-center mb-8 slide-in">
          <div class="inline-flex items-center gap-3 mb-4">
            <!-- <div class="w-16 h-16 rounded-full bg-gradient-nuts flex items-center justify-center floating pulse-warm">
              <font-awesome-icon :icon="['fas', 'seedling']" class="text-2xl text-white" />
            </div> -->
            <div
              class="rounded-full p-2 bg-gradient-to-br from-yellow-700 to-yellow-500 text-white text-xl animate-bounce">
              <img src="/public/img/fbe92c76-59d0-4525-a1fe-8e06a4c98dbd2.PNG" alt="" class="w-10 h-10" />
            </div>
          </div>
          <h1 class="text-3xl font-bold text-dark-chocolate mb-2">¡Registrate!</h1>
          <p class="text-gray-dark">Crea tu cuenta en Secos y Saludables JPJ</p>
        </div>

        <!-- Formulario de registro -->
        <div class="glass-effect rounded-2xl p-8 shadow-2xl slide-in delay-200">
          <form @submit.prevent="handleRegister" class="space-y-8">

            <!-- Datos de contacto -->
            <div class="space-y-6">
              <div class="border-b border-gray-200 pb-4">
                <h2 class="text-xl font-semibold text-dark-chocolate flex items-center gap-2">
                  <font-awesome-icon :icon="['fas', 'address-book']" class="text-olive-green" />
                  Ingresa tus datos de contacto
                </h2>
              </div>

              <!-- Email con UiInput -->
              <UiInput id="email" v-model="form.email" type="email" label="Correo electrónico"
                placeholder="correo@ejemplo.com" :icon="['fas', 'envelope']" :prefix-icon="['fas', 'at']"
                :error="errors.email" required />

              <!-- Teléfono con UiInput -->
              <UiInput id="phone" v-model="form.phone" type="tel" label="Teléfono" placeholder="+56 9 1234 5678"
                :icon="['fas', 'phone']" :prefix-icon="['fas', 'mobile-alt']" :error="errors.phone"
                helper-text="Usaremos estos datos para verificar tu identidad y enviar información sobre tus compras."
                required />
            </div>

            <!-- Información personal -->
            <div class="space-y-6">
              <div class="border-b border-gray-200 pb-4">
                <h2 class="text-xl font-semibold text-dark-chocolate flex items-center gap-2">
                  <font-awesome-icon :icon="['fas', 'user']" class="text-olive-green" />
                  ¿Cuál es tu nombre?
                </h2>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nombre -->
                <UiInput id="name" v-model="form.name" type="text" label="Nombre" placeholder="Tu nombre"
                  :error="errors.name" required />

                <!-- Apellido -->
                <UiInput id="apellido" v-model="form.apellido" type="text" label="Apellido" placeholder="Tu apellido"
                  :error="errors.apellido" required />
              </div>
            </div>

            <!-- RUT/Pasaporte -->
            <div class="space-y-6">
              <div class="border-b border-gray-200 pb-4">
                <h2 class="text-xl font-semibold text-dark-chocolate flex items-center gap-2">
                  <font-awesome-icon :icon="['fas', 'id-card']" class="text-olive-green" />
                  ¿Cuál es tu RUT/Pasaporte?
                </h2>
              </div>

              <!-- RUT con formato automático -->
              <UiInput id="rut" v-model="form.rut" type="text" label="RUT" placeholder="12.345.678-9"
                :icon="['fas', 'id-card']" :prefix-icon="['fas', 'id-badge']" :error="errors.rut"
                helper-text="Verifica que el RUT/Pasaporte sea el tuyo y que tus datos coincidan con el documento."
                @input="formatRut" required />
            </div>

            <!-- Contraseña -->
            <div class="space-y-6">
              <div class="border-b border-gray-200 pb-4">
                <h2 class="text-xl font-semibold text-dark-chocolate flex items-center gap-2">
                  <font-awesome-icon :icon="['fas', 'lock']" class="text-olive-green" />
                  Ahora, crea tu contraseña
                </h2>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Contraseña -->
                <UiInput id="password" v-model="form.password" type="password" label="Contraseña" placeholder="••••••••"
                  :error="errors.password" :show-password-toggle="true" required />

                <!-- Confirmar contraseña -->
                <UiInput id="confirmPassword" v-model="form.confirmPassword" type="password"
                  label="Confirma la contraseña" placeholder="••••••••" :error="errors.confirmPassword"
                  :show-password-toggle="true" required />
              </div>

              <!-- Indicador de fortaleza -->
              <div v-if="form.password" class="space-y-2">
                <div class="text-sm font-medium text-gray-dark">Fortaleza de contraseña:</div>
                <div class="flex space-x-1">
                  <div v-for="i in 4" :key="i" class="h-2 flex-1 rounded-full transition-colors"
                    :class="getPasswordStrengthClass(i)"></div>
                </div>
                <p class="text-xs" :class="getPasswordStrengthTextClass()">
                  {{ passwordStrengthText }}
                </p>
              </div>
            </div>

            <!-- Términos y condiciones -->
            <div class="space-y-4">
              <label class="flex items-start cursor-pointer group">
                <input v-model="form.acceptTerms" type="checkbox"
                  class="mt-1 w-4 h-4 rounded border-2 border-gray-300 text-olive-green focus:ring-olive-green" />
                <span class="ml-3 text-sm text-gray-dark leading-relaxed">
                  Al crear tu cuenta estás aceptando
                  <a href="/terminos" target="_blank" class="text-olive-green hover:text-nut-brown font-semibold">
                    Términos y Condiciones
                  </a>
                  y las
                  <a href="/privacidad" target="_blank" class="text-olive-green hover:text-nut-brown font-semibold">
                    Políticas de Privacidad
                  </a>.
                </span>
              </label>
              <p v-if="errors.acceptTerms" class="text-burgundy-red text-sm">
                <font-awesome-icon :icon="['fas', 'exclamation-circle']" class="mr-1" />
                {{ errors.acceptTerms }}
              </p>
            </div>

            <!-- Botón de registro -->
            <UiButtons tipo="agregar" :label="'Crear cuenta'" :accion="crearCuenta" :loading="loading"
              :isFormValid="isFormValid" icono="user-plus" loadingText="Creando cuenta..." />
          </form>


          <!-- Ya tienes cuenta -->
          <div class="mt-8 text-center">
            <p class="text-gray-dark">
              ¿Tienes cuenta?
              <router-link to="/login" class="text-olive-green hover:text-nut-brown font-semibold transition-colors">
                Inicia sesión
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
    <ToastNotification :show="toast.show" :type="toast.type" :message="toast.message" @close="toast.show = false" />
  </div>
</template>

<script>
import { ref, reactive, computed } from 'vue'
import { useRouter } from 'vue-router'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import {
  faEnvelope,
  faPhone,
  faUser,
  faIdCard,
  faLock,
  faUserPlus,
  faSpinner,
  faEye,
  faEyeSlash,
  faArrowLeft,
  faCheckCircle,
  faExclamationCircle,
  faTimes,
  faSeedling,
  faAddressBook
} from '@fortawesome/free-solid-svg-icons'
import { useUser } from "../../application/callbacks/user.cb"
import { registerUserSchema } from "../../domain/schema/user.shema"
import NutDecoration from '../components/NutDecoration/NutDecoration.vue'
import UiButtons from '../components/Buttons/UiButtons.vue'
import UiInput from '../components/Input/UiInput.vue'
import ToastNotification from '../components/Toast/ToastNotification.vue'
library.add(
  faEnvelope,
  faPhone,
  faUser,
  faIdCard,
  faLock,
  faUserPlus,
  faSpinner,
  faEye,
  faEyeSlash,
  faArrowLeft,
  faCheckCircle,
  faExclamationCircle,
  faTimes,
  faSeedling,
  faAddressBook
)

export default {
  name: 'RegisterPage',
  components: {
    FontAwesomeIcon,
    NutDecoration,
    UiButtons,
    UiInput,
    ToastNotification
  },
  setup() {
    const router = useRouter()
    const { register, loading, error: userError } = useUser()

    const form = reactive({
      email: '',
      phone: '',
      name: '',
      apellido: '',
      rut: '',
      password: '',
      confirmPassword: '',
      acceptTerms: false
    })

    const errors = reactive({
      email: '',
      phone: '',
      name: '',
      apellido: '',
      rut: '',
      password: '',
      confirmPassword: '',
      acceptTerms: ''
    })

    const showPassword = ref(false)
    const showConfirmPassword = ref(false)

    const toast = reactive({
      show: false,
      message: '',
      type: 'success'
    })

    const inputClass = (field) => {
      const baseClass = 'w-full px-4 py-3 rounded-lg input-focus bg-white text-dark-chocolate placeholder-gray-400 border-2'
      return `${baseClass} ${errors[field] ? 'border-burgundy-red' : 'border-gray-200'}`
    }

    const isFormValid = computed(() => {
      return Object.values(errors).every(e => e === '') &&
        form.email &&
        form.password &&
        form.confirmPassword &&
        form.name &&
        form.apellido &&
        form.rut &&
        form.phone &&
        form.acceptTerms
    })

    const toastBorderClass = computed(() =>
      toast.type === 'error' ? 'border-burgundy-red' : 'border-olive-green'
    )

    const toastIcon = computed(() =>
      toast.type === 'error' ? ['fas', 'exclamation-circle'] : ['fas', 'check-circle']
    )

    const toastIconClass = computed(() =>
      toast.type === 'error' ? 'text-burgundy-red' : 'text-olive-green'
    )

    const togglePassword = () => {
      showPassword.value = !showPassword.value
    }

    const toggleConfirmPassword = () => {
      showConfirmPassword.value = !showConfirmPassword.value
    }

    const hideToast = () => {
      toast.show = false
    }

    const showToast = (msg, type = 'success') => {
      toast.message = msg
      toast.type = type
      toast.show = true
      setTimeout(() => {
        toast.show = false
      }, 5000)
    }

    const clearErrors = () => {
      Object.keys(errors).forEach(key => {
        errors[key] = ''
      })
    }

    const handleRegister = async () => {
      try {
        clearErrors()

        // Validar con el schema
        await registerUserSchema.validate(form, { abortEarly: false })

        // Preparar el payload
        const payload = {
          email: form.email,
          phone: form.phone,
          name: form.name,
          apellido: form.apellido,
          rut: form.rut,
          password: form.password
        }

        // Llamar al servicio de registro
        let registro = await register(payload)

        console.log(registro);
        // Si llegó aquí, el registro fue exitoso
        showToast('¡Cuenta creada exitosamente!', 'success')

        // Redirigir al login después de 2 segundos
        // setTimeout(() => {
        //   router.push('/login')
        // }, 2000)
      } catch (err) {
        console.error('Error en registro:', err)

        // Manejar errores de validación del schema
        if (err.inner) {
          err.inner.forEach(e => {
            errors[e.path] = e.message
          })
          showToast('Por favor, corrige los errores en el formulario', 'error')
        }
        // Manejar errores del API
        else if (userError.value) {
          showToast(userError.value, 'error')
        }
        // Manejar otros errores
        else {
          showToast(err.message || 'Error al crear la cuenta', 'error')
        }
      }
    }

    const formatRut = (e) => {
      let value = e.target.value.replace(/[^0-9kK]/g, '')
      if (value.length > 1) {
        const body = value.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.')
        const dv = value.slice(-1)
        form.rut = `${body}-${dv}`
      } else {
        form.rut = value
      }
    }

    const getPasswordStrength = () => {
      const password = form.password
      if (!password) return 0

      let score = 0
      if (password.length >= 8) score++
      if (password.length >= 12) score++
      if (/[a-z]/.test(password)) score++
      if (/[A-Z]/.test(password)) score++
      if (/[0-9]/.test(password)) score++
      if (/[^A-Za-z0-9]/.test(password)) score++

      return Math.min(score, 4)
    }

    const getPasswordStrengthClass = (i) => {
      const strength = getPasswordStrength()
      if (i <= strength) {
        if (strength <= 1) return 'bg-burgundy-red'
        if (strength <= 2) return 'bg-orange-warm'
        if (strength <= 3) return 'bg-golden-yellow'
        return 'bg-olive-green'
      }
      return 'bg-gray-300'
    }

    const getPasswordStrengthTextClass = () => {
      const strength = getPasswordStrength()
      if (strength <= 1) return 'text-burgundy-red'
      if (strength <= 2) return 'text-orange-warm'
      if (strength <= 3) return 'text-golden-yellow'
      return 'text-olive-green'
    }

    const passwordStrengthText = computed(() => {
      const texts = ['Muy débil', 'Débil', 'Regular', 'Buena', 'Fuerte']
      return texts[getPasswordStrength()] || 'Muy débil'
    })

    return {
      form,
      errors,
      loading,
      showPassword,
      showConfirmPassword,
      toast,
      inputClass,
      isFormValid,
      toastBorderClass,
      toastIcon,
      toastIconClass,
      togglePassword,
      toggleConfirmPassword,
      hideToast,
      showToast,
      handleRegister,
      formatRut,
      getPasswordStrengthClass,
      getPasswordStrengthTextClass,
      passwordStrengthText
    }
  }
}
</script>