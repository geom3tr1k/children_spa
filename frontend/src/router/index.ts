import ABoutUsViews from '@/views/ABoutUsViews.vue'
import AdminViews from '@/views/AdminViews.vue'
import BonusViews from '@/views/BonusViews.vue'
import CartViews from '@/views/CartViews.vue'
import CatalogViews from '@/views/CatalogViews.vue'
import ContactsViews from '@/views/ContactsViews.vue'
import LoginViews from '@/views/LoginViews.vue'
import MainViews from '@/views/MainViews.vue'
import NoFoundViews from '@/views/NoFoundViews.vue'
import PersonalAccountViews from '@/views/PersonalAccountViews.vue'
import RegisterViews from '@/views/RegisterViews.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'main',
      component: MainViews,
    },
    {
      path: '/account',
      name: 'account',
      component: PersonalAccountViews,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterViews,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginViews,
    },
    {
      path: '/admin',
      name: 'Admin',
      component: AdminViews,
    },
    {
      path: '/about',
      name: 'About',
      component: ABoutUsViews,
    },
    {
      path: '/contacts',
      name: 'Contacts',
      component: ContactsViews,
    },
    {
      path: '/bonus',
      name: 'Bonus',
      component: BonusViews,
    },
    {
      path: '/catalog',
      name: 'Catalog',
      component: CatalogViews,
    },
    {
      path: '/cart',
      name: 'cart',
      component: CartViews,
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: NoFoundViews,
    },
  ],
})

router.beforeEach((to) => {
  const Auth = localStorage.getItem('token')
  const Role = localStorage.getItem('role')
  if (!Auth && to.name === 'account') {
    return { name: 'login' }
  }
  if (Auth && (to.name === 'login' || to.name === 'register')) {
    return { name: 'main' }
  }
  if (Role === 'user' && to.name === 'Admin') {
    return { name: 'NotFound' }
  }
  if (!Role && to.name === 'Admin') {
    return { name: 'NotFound' }
  }
  return true
})

export default router
