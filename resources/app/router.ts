import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(window.config.base_url || '/'), // 👈 set base path here
  routes: [
    {
      path: '/',
      redirect: { name: 'dashboard' }
    },
    {
      path: '/dashboard',
      component: () => import('./views/dashboard/index.vue'),
      name: 'dashboard'
    }
  ],
})

export default router