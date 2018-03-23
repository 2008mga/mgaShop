import { Api } from '@/scripts/_api'
import Vue from 'vue'
import VueLocalStorage from 'vue-localstorage'

Vue.use(VueLocalStorage)

export default {
  namespaced: true,
  state: {
    auth: false,
    token: null,
    info: {
      name: null,
      login: null,
      email: null
    }
  },
  mutations: {
    fill (state, user) {
      state.auth = true
      state.info = user
    },
    refreshToken (state) {
      if (!Vue.localStorage.get('auth')) {
        return false
      }

      state.auth = true
      state.token = Vue.localStorage.get('auth')
    },
    saveToken (state, token) {
      Vue.localStorage.set('auth', token)
      state.token = Vue.localStorage.get('auth')
    },
    logout (state) {
      Vue.localStorage.remove('auth')
      state.token = null
      state.info = null
      state.auth = false
    }
  },
  actions: {
    login ({commit, dispatch}, credentials) {
      Api()
        .post('/auth', credentials)
        .then((req) => {
          commit('saveToken', req.data.data.access_token)
          dispatch('me')
        })
    },
    me ({state, commit}) {
      if (!Vue.localStorage.get('auth')) {
        commit('logout')
        return false
      } else {
        if (!state.token) {
          commit('refreshToken')
        }

        Api()
          .get('/user')
          .then((req) => {
            commit('fill', req.data.data)
          })
      }
    },
    logout ({ commit }) {
      commit('logout')
    }
  }
}
