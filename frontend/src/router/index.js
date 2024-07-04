import { createRouter, createWebHistory } from 'vue-router'
import CadastroView from '../views/CadastroView.vue'
import LoginView from '../views/LoginView.vue'

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
      meta: { requiresAuth: true }, 
    }
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
