// src/stores/auth.ts
import { defineStore } from 'pinia'
import api from '../plugins/axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as null | { id: number; name: string; email: string },
  }),
  actions: {
    async fetchUser() {
      try {
        const { data } = await api.get('/api/user')
        this.user = data
      } catch {
        this.user = null
      }
    },
    async login(email: string, password: string) {
      await api.post('/login', { email, password })
      await this.fetchUser()
    },
    async register(name: string, email: string, password: string) {
      await api.post('/register', { name, email, password, password_confirmation: password })
      await this.fetchUser()
    },
    async logout() {
      await api.post('/logout')
      this.user = null
    },
  },
})