import { createRouter, createWebHashHistory } from 'vue-router'

const login = () => import('../components/user/logIn.vue')
const dashboard = () => import('../dashBoard.vue')
const collection = () => import('../components/user/collectionView.vue')
const discover = () => import('../components/user/discoverView.vue')
const admin = () => import('../components/admin/adminPanel.vue')

const router = createRouter({
  history: createWebHashHistory(),
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
    },

    {
      path: '/collections',
      name: 'collectionView',
      component: collection,
      meta: {title: "Collections"}
    },

    {
      path: '/discover',
      name: 'discoverView',
      component: discover,
      meta: {title: "Discover"}
    },

    {
      path: '/admin',
      name: 'adminPanel',
      component: admin,
      meta: {title: "Admin Panel"}
    }
  ],
})

export default router
