import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "./stores/auth";

const router = createRouter({
  history: createWebHistory(window.config.base_url || "/"), // 👈 set base path here
  routes: [
    {
      path: "/",
      redirect: { name: "dashboard" },
    },
    {
      path: "/dashboard",
      component: () => import("./views/dashboard/index.vue"),
      name: "dashboard",
      meta: { requiresAuth: true },
    },
    {
      path: "/login",
      component: () => import("./views/auth/login.vue"),
      name: "login",
    },
    {
      path: "/register",
      component: () => import("./views/auth/register.vue"),
      name: "register",
    },
  ],
});

router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore();

  // Jika belum ada user di store, coba fetch dari backend
  if (!auth.user) {
    await auth.fetchUser();
  }

  if (to.meta.requiresAuth && !auth.user) {
    next({ name: "login" });
  } else if (to.name === "login" && auth.user) {
    // 🔹 Kalau sudah login, jangan ke /login lagi → redirect ke dashboard
    next({ name: "dashboard" });
  } else {
    next();
  }
});

export default router;
