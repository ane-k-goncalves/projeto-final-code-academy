
import axios from 'axios';
import { createStore } from "vuex";

export default createStore({

  state: {
    user: null,
    token: localStorage.getItem('token') || null,
  },
  getters: {
    isAuthenticated: state => !!state.token,
    getUser: state => state.user,
    getToken: state => state.token,
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },
    SET_TOKEN(state, token) {
      state.token = token;
      localStorage.setItem('token', token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    },
    CLEAR_USER(state) {
      state.user = null;
    },
    CLEAR_TOKEN(state) {
      state.token = null;
      localStorage.removeItem('token');
      delete axios.defaults.headers.common['Authorization'];
    }
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('http://localhost:8000/api/login', credentials);
        commit('SET_USER', response.data.user);
        commit('SET_TOKEN', response.data.token);
      } catch (error) {
        console.error('Erro no login:', error);
        throw error;
      }
    },
    async logout({ commit }) {
      try {
        await axios.post('http://localhost:8000/api/logout');
        commit('CLEAR_USER');
        commit('CLEAR_TOKEN');
      } catch (error) {
        console.error('Erro no logout:', error);
      }
    },
  },
  modules: {},
});
