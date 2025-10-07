<template>
  <div class="min-h-screen bg-pattern relative overflow-hidden">
    <NutDecoration />
    
    <div class="absolute inset-0 bg-gradient-to-br from-beige via-transparent to-mint-green opacity-30"></div>
    
    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
      <div class="w-full max-w-md">
        
        <!-- Logo y título -->
        <div class="text-center mb-8 slide-in">
          <div class="inline-flex items-center gap-3 mb-4">
            <div class="rounded-full p-2 bg-gradient-to-br from-yellow-700 to-yellow-500 text-white text-xl animate-bounce">
              <img src="/public/img/fbe92c76-59d0-4525-a1fe-8e06a4c98dbd2.PNG" alt="" class="w-10 h-10" />
            </div>
          </div>
          <h1 class="text-3xl font-bold text-dark-chocolate mb-2">
            {{ currentStep === 'email' ? 'Restablecer contraseña' : 'Nueva contraseña' }}
          </h1>
          <p class="text-gray-dark">
            {{ currentStep === 'email' 
              ? 'Ingresa tu correo electrónico y te enviaremos las instrucciones para una nueva contraseña.' 
              : 'Ingresa una nueva contraseña para tu cuenta y evita que se repita con las que utilizaste anteriormente.' 
            }}
          </p>
        </div>

        <!-- Formulario paso 1: Solicitar código -->
        <div v-if="currentStep === 'email'" class="glass-effect rounded-2xl p-8 shadow-2xl slide-in delay-200">
          <form @submit.prevent="handleSendCode" class="space-y-6">
            
            <!-- Email -->
            <UiInput 
              id="email" 
              v-model="form.email" 
              type="email" 
              label="Correo Electrónico" 
              placeholder="tu@email.com"
              :icon="['fas', 'envelope']" 
              :error="errors.email" 
              required 
            />

            <!-- Botón enviar -->
            <UiButtons 
              tipo="agregar" 
              :accion="handleSendCode" 
              :label="isLoading ? 'Enviando...' : 'Continuar'"
              :loading="isLoading" 
              :isFormValid="isEmailValid" 
              icono="paper-plane" 
            />

            <!-- Link para código existente -->
            <div class="text-center">
              <button 
                @click="currentStep = 'reset'" 
                type="button"
                class="text-sm text-olive-green hover:text-nut-brown transition-colors font-semibold"
              >
                Ya tengo el código verificador
              </button>
            </div>
          </form>
        </div>

        <!-- Formulario paso 2: Restablecer contraseña -->
        <div v-if="currentStep === 'reset'" class="glass-effect rounded-2xl p-8 shadow-2xl slide-in delay-200">
          <form @submit.prevent="handleResetPassword" class="space-y-6">
            
            <!-- Email -->
            <UiInput 
              id="reset-email" 
              v-model="form.email" 
              type="email" 
              label="Correo Electrónico" 
              placeholder="tu@email.com"
              :icon="['fas', 'envelope']" 
              :error="errors.email" 
              required 
            />

            <!-- Código verificador -->
            <UiInput 
              id="code" 
              v-model="form.code" 
              type="text" 
              label="Código verificador" 
              placeholder="000000"
              :icon="['fas', 'key']" 
              :error="errors.code"
              maxlength="6"
              required 
            />

            <!-- Nueva contraseña -->
            <div>
              <UiInput 
                id="new-password" 
                v-model="form.newPassword" 
                :type="showPassword ? 'text' : 'password'" 
                label="Nueva contraseña" 
                placeholder="••••••••"
                :show-password-toggle="true"
                :icon="['fas', 'lock']" 
                :error="errors.newPassword"
                @toggle-password="togglePassword" 
                required 
              />
              
              <!-- Validaciones de contraseña -->
              <div class="mt-3 space-y-2">
                <div class="flex items-center gap-2 text-sm">
                  <font-awesome-icon 
                    :icon="['fas', passwordValidations.minLength ? 'check-circle' : 'circle']" 
                    :class="passwordValidations.minLength ? 'text-olive-green' : 'text-gray-400'"
                  />
                  <span :class="passwordValidations.minLength ? 'text-olive-green' : 'text-gray-dark'">
                    Mín. 8 caracteres
                  </span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                  <font-awesome-icon 
                    :icon="['fas', passwordValidations.hasNumber ? 'check-circle' : 'circle']" 
                    :class="passwordValidations.hasNumber ? 'text-olive-green' : 'text-gray-400'"
                  />
                  <span :class="passwordValidations.hasNumber ? 'text-olive-green' : 'text-gray-dark'">
                    1 número
                  </span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                  <font-awesome-icon 
                    :icon="['fas', passwordValidations.hasUppercase ? 'check-circle' : 'circle']" 
                    :class="passwordValidations.hasUppercase ? 'text-olive-green' : 'text-gray-400'"
                  />
                  <span :class="passwordValidations.hasUppercase ? 'text-olive-green' : 'text-gray-dark'">
                    1 mayúscula
                  </span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                  <font-awesome-icon 
                    :icon="['fas', passwordValidations.hasLowercase ? 'check-circle' : 'circle']" 
                    :class="passwordValidations.hasLowercase ? 'text-olive-green' : 'text-gray-400'"
                  />
                  <span :class="passwordValidations.hasLowercase ? 'text-olive-green' : 'text-gray-dark'">
                    1 minúscula
                  </span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                  <font-awesome-icon 
                    :icon="['fas', passwordValidations.noSpaces ? 'check-circle' : 'circle']" 
                    :class="passwordValidations.noSpaces ? 'text-olive-green' : 'text-gray-400'"
                  />
                  <span :class="passwordValidations.noSpaces ? 'text-olive-green' : 'text-gray-dark'">
                    Sin espacio
                  </span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                  <font-awesome-icon 
                    :icon="['fas', passwordValidations.noSpecialChars ? 'check-circle' : 'circle']" 
                    :class="passwordValidations.noSpecialChars ? 'text-olive-green' : 'text-gray-400'"
                  />
                  <span :class="passwordValidations.noSpecialChars ? 'text-olive-green' : 'text-gray-dark'">
                    Sin usar '\¡¿"ºª·`´çñÑ
                  </span>
                </div>
              </div>
            </div>

            <!-- Botón crear -->
            <UiButtons 
              tipo="agregar" 
              :accion="handleResetPassword" 
              label="Crear"
              :loading="isLoading" 
              :isFormValid="isResetFormValid" 
              icono="check" 
            />

            <!-- Reenviar código -->
            <div class="text-center">
              <p class="text-sm text-gray-dark mb-2">¿Aún no te llega?</p>
              <button 
                @click="handleResendCode" 
                type="button"
                :disabled="resendCooldown > 0"
                class="text-sm text-olive-green hover:text-nut-brown transition-colors font-semibold disabled:opacity-50 disabled:cursor-not-allowed"
              >
                {{ resendCooldown > 0 
                  ? `Espera ${resendCooldown}s para reenviar` 
                  : 'Puedes pedir un nuevo código por correo' 
                }}
              </button>
            </div>
          </form>
        </div>

        <!-- Enlaces adicionales -->
        <div class="text-center mt-6 slide-in delay-400">
          <router-link to="/login" class="inline-flex items-center text-gray-dark hover:text-olive-green transition-colors">
            <font-awesome-icon :icon="['fas', 'arrow-left']" class="mr-2" />
            Volver al inicio de sesión
          </router-link>
        </div>

      </div>
    </div>

    <ToastNotification 
      :show="toast.show" 
      :type="toast.type" 
      :message="toast.message" 
      @close="toast.show = false" 
    />
  </div>
</template>

<script>
import { ref, reactive, computed, watch } from 'vue'
import { useRouter } from 'vue-router'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import {
  faEnvelope,
  faLock,
  faKey,
  faPaperPlane,
  faCheck,
  faCheckCircle,
  faCircle,
  faArrowLeft,
  faExclamationCircle,
  faTimes
} from '@fortawesome/free-solid-svg-icons'
import NutDecoration from '../components/NutDecoration/NutDecoration.vue'
import UiButtons from '../components/Buttons/UiButtons.vue'
import UiInput from '../components/Input/UiInput.vue'
import ToastNotification from '../components/Toast/ToastNotification.vue'

library.add(
  faEnvelope,
  faLock,
  faKey,
  faPaperPlane,
  faCheck,
  faCheckCircle,
  faCircle,
  faArrowLeft,
  faExclamationCircle,
  faTimes
)

export default {
  name: 'ForgotPasswordPage',
  components: {
    FontAwesomeIcon,
    UiButtons,
    ToastNotification,
    UiInput,
    NutDecoration
  },
  setup() {
    const router = useRouter()

    // Estado del formulario
    const form = reactive({
      email: '',
      code: '',
      newPassword: ''
    })

    // Estado de errores
    const errors = reactive({
      email: '',
      code: '',
      newPassword: ''
    })

    // Estados de la UI
    const currentStep = ref('email') // 'email' o 'reset'
    const isLoading = ref(false)
    const showPassword = ref(false)
    const resendCooldown = ref(0)

    // Toast notifications
    const toast = reactive({
      show: false,
      message: '',
      type: 'success'
    })

    // Validaciones de contraseña
    const passwordValidations = computed(() => ({
      minLength: form.newPassword.length >= 8,
      hasNumber: /\d/.test(form.newPassword),
      hasUppercase: /[A-Z]/.test(form.newPassword),
      hasLowercase: /[a-z]/.test(form.newPassword),
      noSpaces: !/\s/.test(form.newPassword),
      noSpecialChars: !/[\\¡¿"ºª·`´çñÑ]/.test(form.newPassword)
    }))

    // Computed properties
    const isValidEmail = (email) => {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      return emailRegex.test(email)
    }

    const isEmailValid = computed(() => {
      return form.email && !errors.email && isValidEmail(form.email)
    })

    const isPasswordValid = computed(() => {
      return Object.values(passwordValidations.value).every(v => v === true)
    })

    const isResetFormValid = computed(() => {
      return form.email && 
             form.code && 
             form.newPassword &&
             !errors.email && 
             !errors.code && 
             !errors.newPassword &&
             isValidEmail(form.email) &&
             isPasswordValid.value
    })

    // Watch para validar contraseña en tiempo real
    watch(() => form.newPassword, (newVal) => {
      if (newVal && !isPasswordValid.value) {
        errors.newPassword = 'La contraseña no cumple con todos los requisitos'
      } else {
        errors.newPassword = ''
      }
    })

    // Methods
    const validateEmail = () => {
      if (!form.email) {
        errors.email = 'El email es requerido'
      } else if (!isValidEmail(form.email)) {
        errors.email = 'Por favor ingresa un email válido'
      } else {
        errors.email = ''
      }
    }

    const validateCode = () => {
      if (!form.code) {
        errors.code = 'El código es requerido'
      } else if (form.code.length !== 6) {
        errors.code = 'El código debe tener 6 dígitos'
      } else if (!/^\d+$/.test(form.code)) {
        errors.code = 'El código solo debe contener números'
      } else {
        errors.code = ''
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
        toast.show = false
      }, 5000)
    }

    const startResendCooldown = () => {
      resendCooldown.value = 60
      const interval = setInterval(() => {
        resendCooldown.value--
        if (resendCooldown.value <= 0) {
          clearInterval(interval)
        }
      }, 1000)
    }

    const handleSendCode = async () => {
      validateEmail()

      if (!isEmailValid.value) {
        showToast('Por favor ingresa un email válido', 'error')
        return
      }

      isLoading.value = true

      try {
        await new Promise(resolve => setTimeout(resolve, 2000))

        showToast('¡Código enviado! Revisa tu correo electrónico', 'success')
        currentStep.value = 'reset'
        startResendCooldown()
      } catch (error) {
        showToast('Error al enviar el código. Intenta nuevamente.', 'error')
        console.error('Send code error:', error)
      } finally {
        isLoading.value = false
      }
    }

    const handleResendCode = async () => {
      if (resendCooldown.value > 0) return

      validateEmail()

      if (!isEmailValid.value) {
        showToast('Por favor ingresa un email válido', 'error')
        return
      }

      try {
        await new Promise(resolve => setTimeout(resolve, 1500))
        showToast('¡Nuevo código enviado!', 'success')
        startResendCooldown()
      } catch (error) {
        showToast('Error al reenviar el código', 'error')
      }
    }

    const handleResetPassword = async () => {
      validateEmail()
      validateCode()

      if (!isResetFormValid.value) {
        showToast('Por favor completa todos los campos correctamente', 'error')
        return
      }

      isLoading.value = true

      try {
        await new Promise(resolve => setTimeout(resolve, 2000))

        // Validación demo (reemplazar con tu lógica real)
        if (form.code === '123456') {
          showToast('¡Contraseña restablecida exitosamente!', 'success')
          
          setTimeout(() => {
            router.push('/login')
          }, 2000)
        } else {
          showToast('Código incorrecto. Usa 123456 para probar', 'error')
        }
      } catch (error) {
        showToast('Error al restablecer la contraseña', 'error')
        console.error('Reset password error:', error)
      } finally {
        isLoading.value = false
      }
    }

    return {
      form,
      errors,
      currentStep,
      isLoading,
      showPassword,
      resendCooldown,
      toast,
      passwordValidations,
      isEmailValid,
      isPasswordValid,
      isResetFormValid,
      validateEmail,
      validateCode,
      togglePassword,
      showToast,
      handleSendCode,
      handleResendCode,
      handleResetPassword
    }
  }
}
</script>