<script setup lang="ts">
import { ref } from 'vue'
import { useAuthStore } from '../../stores/auth'
import { useRouter } from 'vue-router'

const auth = useAuthStore()
const router = useRouter()

const name = ref('')
const email = ref('')
const password = ref('')
const error = ref('')

const register = async () => {
  try {
    await auth.register(name.value, email.value, password.value)
    router.push({ name: 'dashboard' }) // redirect otomatis
  } catch {
    error.value = 'Register gagal'
  }
}
</script>

<template>
  <form @submit.prevent="register">
    <input v-model="name" placeholder="Name" />
    <input v-model="email" placeholder="Email" />
    <input v-model="password" type="password" />
    <button type="submit">Register</button>
    <p v-if="error">{{ error }}</p>
  </form>
</template>