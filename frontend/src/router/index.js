import { createRouter, createWebHistory } from 'vue-router'
import CadastroView from '../views/CadastroView.vue'
import LoginView from '../views/LoginView.vue'
import Guard from '../services/LoginMiddleware'
import ResetPassword from '@/views/ResetPassword.vue'

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
<<<<<<< HEAD
    path: '/reset-password/:token',
    name: 'ResetPassword',
    component: ResetPassword,
   
=======
      path: '/teste',
      name: 'Teste',
      component: () => import('../views/teste.vue'),
      beforeEnter: Guard.auth
>>>>>>> bf61489 (estrutura navbar)
    }
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
