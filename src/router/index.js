import { createRouter, createWebHistory } from 'vue-router'

const login = () => import('../components/user/logIn.vue')
const dashboard = () => import('../dashBoard.vue')

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: dashboard,
    },

    {
      path: '/login',
      name: 'logIn',
      component: login,
      meta: {title: "Login"}
    }
  ],
})

export default router
