// src/stores/products.js
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import productsApi from '@/services/api/products'

export const useProductsStore = defineStore('products', () => {
  const products = ref([])
  const currentProduct = ref(null)
  const loading = ref(false)
  const error = ref(null)
  const meta = ref({})
  
  const featuredProducts = computed(() => 
    products.value.filter(product => product.is_featured)
  )
  
  const getProducts = async (filters = {}) => {
    loading.value = true
    error.value = null
    
    try {
      const response = await productsApi.getProducts(filters)
      products.value = response.data.data
      meta.value = response.data.meta
    } catch (err) {
      error.value = err.message
    } finally {
      loading.value = false
    }
  }
  
  const getProductBySlug = async (slug) => {
    loading.value = true
    error.value = null
    
    try {
      const response = await productsApi.getProduct(slug)
      currentProduct.value = response.data
      return response.data
    } catch (err) {
      error.value = err.message
      throw err
    } finally {
      loading.value = false
    }
  }
  
  return {
    products,
    currentProduct,
    loading,
    error,
    meta,
    featuredProducts,
    getProducts,
    getProductBySlug
  }
})