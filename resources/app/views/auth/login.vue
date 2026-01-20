<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";
import AuthLayout from "@/components/app/AuthLayout.vue";

const auth = useAuthStore();
const router = useRouter();

const email = ref("");
const password = ref("");
const remember = ref(false);
const error = ref("");

const login = async () => {
  try {
    await auth.login(email.value, password.value);
  } catch {
    error.value = "Email atau password yang anda masukan salah";
  }
};
</script>

<template>
  <AuthLayout>
    <div class="login-content fs-13px">
      <form @submit.prevent="login">
        <div class="form-floating mb-20px">
          <input
            type="email"
            class="form-control fs-13px h-45px"
            id="emailAddress"
            placeholder="Email Address"
            v-model="email"
            required
          />
          <p v-if="error">{{ error }}</p>
          <label for="emailAddress" class="d-flex align-items-center py-0"
            >Email Address</label
          >
        </div>
        <div class="form-floating mb-20px">
          <input
            type="password"
            class="form-control fs-13px h-45px"
            id="password"
            placeholder="Password"
            v-model="password"
            required
          />
          <p v-if="error">{{ error }}</p>
          <label for="password" class="d-flex align-items-center py-0"
            >Password</label
          >
        </div>
        <div class="form-check mb-20px">
          <input
            class="form-check-input"
            type="checkbox"
            value=""
            id="rememberMe"
            v-model="remember"
          />
          <label class="form-check-label" for="rememberMe"> Remember Me </label>
        </div>
        <div class="login-buttons">
          <button
            type="submit"
            class="btn h-45px btn-theme d-block w-100 btn-lg"
          >
            Sign me in
          </button>
        </div>
      </form>
    </div>
  </AuthLayout>
</template>
