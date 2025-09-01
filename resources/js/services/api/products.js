// src/services/api/products.js
import axios from '@/services/api/client'

export default {
  getProducts(filters = {}) {
    const params = new URLSearchParams(filters).toString()
    return axios.get(`/products?${params}`)
  },
  
  getProduct(slug) {
    return axios.get(`/products/${slug}`)
  },
  
  getFeaturedProducts() {
    return axios.get('/products/featured')
  }
}

// src/services/api/client.js
import axios from 'axios'

const client = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

// Interceptor para manejar tokens
client.interceptors.request.use(
  config => {
    const token = localStorage.getItem('auth_token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  error => Promise.reject(error)
)

export default client