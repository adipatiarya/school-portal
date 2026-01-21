import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "./stores/auth";
import { RouterName } from "./types";

const router = createRouter({
  history: createWebHistory(window.config.base_url || "/"), // 👈 set base path here
  routes: [
    {
      path: "/",
      redirect: { name: RouterName.DASHBOARD },
    },
    {
      path: "/dashboard",
      component: () => import("./pages/dashboard/index.vue"),
      name: RouterName.DASHBOARD,
      meta: { requiresAuth: true },
    },
    {
      path: "/posts",

      children: [
        {
          path: "",
          component: () => import("./pages/posts/index.vue"),
          name: RouterName.POSTS,
          meta: { requiresAuth: true },
        },

        {
          path: "detail/:id",
          component: () => import("./pages/posts/detail.vue"),
          name: RouterName.POSTS_DETAIL,
          meta: { requiresAuth: true },
        },
        {
          path: "/create",
          component: () => import("./pages/posts/create.vue"),
          name: RouterName.POSTS_CREATE,
          meta: { requiresAuth: true },
        },
      ],
    },

    {
      path: "/auth/login",
      component: () => import("./pages/auth/login.vue"),
      name: RouterName.LOGIN,
    },
    {
      path: "/auth/register",
      component: () => import("./pages/auth/register.vue"),
      name: RouterName.REGISTER,
    },
  ],
});

router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore();

  // Jika belum ada user di store, coba fetch dari backend
  if (auth.isLoading) {
    await auth.waitUntilReady();
  }

  if (to.meta.requiresAuth && !auth.user) {
    next({ name: RouterName.LOGIN });
  } else if (to.name === RouterName.LOGIN && auth.user) {
    // 🔹 Kalau sudah login, jangan ke /login lagi → redirect ke dashboard
    next({ name: RouterName.DASHBOARD });
  } else {
    next();
  }
});

export default router;
