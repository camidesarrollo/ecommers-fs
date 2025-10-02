<template>
    <div class="input-wrapper">
        <!-- Label -->
        <label v-if="label" :for="id" class="block text-sm font-semibold text-dark-chocolate mb-2">
            <font-awesome-icon v-if="icon" :icon="icon" class="text-olive-green mr-2" />
            {{ label }}
        </label>

        <!-- Input Container -->
        <div class="relative">
            <!-- Prefix Icon -->
            <div v-if="prefixIcon"
                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-dark pointer-events-none">
                <font-awesome-icon :icon="prefixIcon" />
            </div>

            <!-- Input Element -->
            <input :id="id" :type="computedType" :value="modelValue" :placeholder="placeholder" :disabled="disabled"
                :readonly="readonly" :required="required" :maxlength="maxlength" :class="inputClasses"
                @input="handleInput" @blur="handleBlur" @focus="handleFocus" />

            <!-- Suffix Icon / Toggle Password -->
            <div v-if="suffixIcon || (type === 'password' && showPasswordToggle)"
                class="absolute right-3 top-1/2 transform -translate-y-1/2"
                :class="{ 'cursor-pointer': type === 'password' && showPasswordToggle }" @click="togglePassword">
                <font-awesome-icon v-if="type === 'password' && showPasswordToggle"
                    :icon="['fas', passwordVisible ? 'eye-slash' : 'eye']"
                    class="text-gray-dark hover:text-olive-green transition-colors" />
                <font-awesome-icon v-else-if="suffixIcon" :icon="suffixIcon" class="text-gray-dark" />
            </div>

            <!-- Loading Spinner -->
            <div v-if="loading" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                <font-awesome-icon :icon="['fas', 'spinner']" class="text-olive-green animate-spin" />
            </div>
        </div>

        <!-- Helper Text -->
        <p v-if="helperText && !error" class="text-xs text-gray-dark mt-1">
            {{ helperText }}
        </p>

        <!-- Error Message -->
        <p v-if="error" class="text-burgundy-red text-sm mt-1 flex items-center gap-1">
            <font-awesome-icon :icon="['fas', 'exclamation-circle']" />
            {{ error }}
        </p>

        <!-- Success Message -->
        <p v-if="success" class="text-olive-green text-sm mt-1 flex items-center gap-1">
            <font-awesome-icon :icon="['fas', 'check-circle']" />
            {{ success }}
        </p>

        <!-- Character Counter -->
        <p v-if="maxlength && showCounter" class="text-xs text-gray-dark mt-1 text-right">
            {{ modelValue?.length || 0 }}/{{ maxlength }}
        </p>
    </div>
</template>

<script>
import { ref, computed } from 'vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export default {
    name: 'UiInput',
    components: {
        FontAwesomeIcon
    },
    props: {
        // v-model
        modelValue: {
            type: [String, Number],
            default: ''
        },
        // Tipo de input
        type: {
            type: String,
            default: 'text',
            validator: (value) => [
                'text', 'email', 'password', 'tel', 'number',
                'url', 'search', 'date', 'time', 'datetime-local'
            ].includes(value)
        },
        // ID único
        id: {
            type: String,
            required: true
        },
        // Label del input
        label: {
            type: String,
            default: ''
        },
        // Placeholder
        placeholder: {
            type: String,
            default: ''
        },
        // Icono para el label
        icon: {
            type: Array,
            default: null
        },
        // Icono prefijo (izquierda)
        prefixIcon: {
            type: Array,
            default: null
        },
        // Icono sufijo (derecha)
        suffixIcon: {
            type: Array,
            default: null
        },
        // Mensaje de error
        error: {
            type: String,
            default: ''
        },
        // Mensaje de éxito
        success: {
            type: String,
            default: ''
        },
        // Texto de ayuda
        helperText: {
            type: String,
            default: ''
        },
        // Estados
        disabled: {
            type: Boolean,
            default: false
        },
        readonly: {
            type: Boolean,
            default: false
        },
        required: {
            type: Boolean,
            default: false
        },
        loading: {
            type: Boolean,
            default: false
        },
        // Longitud máxima
        maxlength: {
            type: Number,
            default: null
        },
        // Mostrar contador de caracteres
        showCounter: {
            type: Boolean,
            default: false
        },
        // Mostrar toggle de contraseña
        showPasswordToggle: {
            type: Boolean,
            default: true
        },
        // Tamaño del input
        size: {
            type: String,
            default: 'md',
            validator: (value) => ['sm', 'md', 'lg'].includes(value)
        },
        // Variante de estilo
        variant: {
            type: String,
            default: 'default',
            validator: (value) => ['default', 'filled', 'outlined'].includes(value)
        }
    },
    emits: ['update:modelValue', 'blur', 'focus', 'input'],
    setup(props, { emit }) {
        const passwordVisible = ref(false)
        const isFocused = ref(false)

        const computedType = computed(() => {
            if (props.type === 'password' && passwordVisible.value) {
                return 'text'
            }
            return props.type
        })

        const inputClasses = computed(() => {
            const baseClasses = 'w-full rounded-lg input-focus transition-all duration-300 text-dark-chocolate placeholder-gray-400'

            // Padding según iconos
            let paddingClass = 'px-4'
            if (props.prefixIcon) paddingClass = 'pl-10 pr-4'
            if (props.suffixIcon || (props.type === 'password' && props.showPasswordToggle) || props.loading) {
                paddingClass = props.prefixIcon ? 'pl-10 pr-10' : 'pl-4 pr-10'
            }

            // Tamaño
            const sizeClasses = {
                sm: 'py-2 text-sm',
                md: 'py-3 text-base',
                lg: 'py-4 text-lg'
            }

            // Variante
            let variantClasses = ''
            if (props.variant === 'filled') {
                variantClasses = 'bg-beige border-transparent'
            } else if (props.variant === 'outlined') {
                variantClasses = 'bg-transparent border-2'
            } else {
                variantClasses = 'bg-white border-2'
            }

            // Estado
            let stateClasses = 'border-gray-light'
            if (props.error) {
                stateClasses = 'border-burgundy-red'
            } else if (props.success) {
                stateClasses = 'border-olive-green'
            } else if (isFocused.value) {
                stateClasses = 'border-olive-green'
            }

            // Disabled
            const disabledClasses = props.disabled ? 'opacity-60 cursor-not-allowed bg-gray-light' : ''

            return `${baseClasses} ${paddingClass} ${sizeClasses[props.size]} ${variantClasses} ${stateClasses} ${disabledClasses}`
        })

        const handleInput = (event) => {
            emit('update:modelValue', event.target.value)
            emit('input', event.target.value)
        }

        const handleBlur = (event) => {
            isFocused.value = false
            emit('blur', event)
        }

        const handleFocus = (event) => {
            isFocused.value = true
            emit('focus', event)
        }

        const togglePassword = () => {
            if (props.type === 'password' && props.showPasswordToggle) {
                passwordVisible.value = !passwordVisible.value
            }
        }

        return {
            passwordVisible,
            isFocused,
            computedType,
            inputClasses,
            handleInput,
            handleBlur,
            handleFocus,
            togglePassword
        }
    }
}
</script>

<style scoped>
.input-wrapper {
    width: 100%;
}
</style>