<script setup lang="ts">
import { ref } from 'vue'
import { useAuthStore } from '../../stores/auth'
import { useRouter } from 'vue-router'

const auth = useAuthStore()
const router = useRouter()

const email = ref('')
const password = ref('')
const error = ref('')

const login = async () => {
  try {
    await auth.login(email.value, password.value)
    router.push({ name: 'dashboard' }) // redirect otomatis
  } catch {
    error.value = 'Login gagal'
  }
}
</script>

<template>
  <form @submit.prevent="login">
    <input v-model="email" placeholder="Email" />
    <input v-model="password" type="password" />
    <button type="submit">Login</button>
    <p v-if="error">{{ error }}</p>
  </form>
</template>