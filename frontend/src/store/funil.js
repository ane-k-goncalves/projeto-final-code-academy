import Vue from 'vue';
import Vuex from 'vuex';
import { getFunis, deleteFunil, createFunil, updateFunil } from '../services/Funil';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    funis: [],
  },
  mutations: {
    SET_FUNIS(state, funis) {
      state.funis = funis;
    },
  },
  actions: {
    async fetchFunis({ commit }) {
      const response = await getFunis();
      commit('SET_FUNIS', response.data);
    },
    async deleteFunil({ dispatch }, id) {
      await deleteFunil(id);
      dispatch('fetchFunis');
    },
    async saveFunil({ dispatch }, funil) {
      if (funil.id) {
        await updateFunil(funil.id, funil);
      } else {
        await createFunil(funil);
      }
      dispatch('fetchFunis');
    },
  },
  getters: {
    allFunis: (state) => state.funis,
  },
});
