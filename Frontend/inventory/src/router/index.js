import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from "@/views/Dashboard.vue";
import Blank from "@/views/Blank.vue";
import Login from "@/views/Login.vue";


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard
    },
    {
      path: '/blank',
      name: 'blank',
      component: Blank
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },

  ]
})

export default router
