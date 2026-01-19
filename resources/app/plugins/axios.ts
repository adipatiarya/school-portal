// src/plugins/axios.ts
import axios from 'axios'

const api = axios.create({
  baseURL: 'http://localhost:8000',
  withCredentials: true,
})


api.interceptors.request.use(async (config) => {
  if (['post','put','delete'].includes(config.method!.toLowerCase())) {
    await api.get('/sanctum/csrf-cookie')
  }
  return config
})

api.interceptors.response.use(
  (response) => response,
  async (error) => {
    if (error.response && error.response.status === 419) {
      // Refresh CSRF cookie
      await api.get('/sanctum/csrf-cookie')
      // Ulangi request yang gagal
      return api(error.config)
    }
    return Promise.reject(error)
  }
)

export default api