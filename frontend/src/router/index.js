import { createRouter, createWebHistory } from 'vue-router'
import CadastroView from '../views/CadastroView.vue'
import LoginView from '../views/LoginView.vue'
import Guard from '../services/LoginMiddleware'

import teste from '@/views/teste.vue'




const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'CadastroView',
      component: () => import('../views/CadastroView.vue'),
      meta: {
        title: 'Cadastro'
      }
    },
    {
      path: '/login',
      name: 'LoginView',
      component: () => import('../views/LoginView.vue'),
      meta: {
        title: 'Login'
      }
    },

    {
      path: '/dashboard',
      name: 'Dashboard',
      component: () => import('../views/Dashboard.vue'),
      beforeEnter: Guard.auth
    },
    {
    path: '/reset-password/:token',
    name: 'ResetPassword',
    component: () => import('../views/ResetPassword.vue'),
    },
    {
      path: '/teste',
      name: 'Teste',
      component: () => import('../views/teste.vue'),
      beforeEnter: Guard.auth
    },

    {
      path: '/verify/email/:id/:hash',
      name: 'VerifyEmail',
      component: () => import('../views/VerifyEmail.vue'),
    },
   
   
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
