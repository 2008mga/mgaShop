import { Api } from '@/scripts/_api'

export default {
  namespaced: true,
  state: {
    categories: null,
    loaded: null,
    products: null
  },
  mutations: {
    updateCategories (state, categories) {
      state.categories = categories
    },
    updateCategory (state, category) {
      let products

      if (state.loaded && state.loaded.id === category.id && category.products_paginate.current_page > 1) {
        // added products if category not change
        products = [].concat(state.products, category.products_paginate.data)
      } else {
        products = category.products_paginate.data
      }

      state.loaded = category
      state.products = products
    }
  },
  actions: {
    loadCategories ({ commit }) {
      Api().get('/categories')
        .then((req) => {
          commit('updateCategories', req.data.data)
        })
        .catch(() => {
          // todo : Make error model for display error
        })
    },
    load ({ commit }, id) {
      Api().get('/categories/' + id)
        .then((req) => {
          commit('updateCategory', req.data.data)
        })
        .catch(() => {
          // todo : Make error  model for display error
        })
    },
    nextPage ({ state, commit }) {
      if (!state.loaded || !state.loaded.products_paginate.next_page_url) {
        return false
      }

      const nextPage = state.loaded.products_paginate.current_page * 1 + 1

      Api().get('/categories/' + state.loaded.id + '?page=' + nextPage)
        .then((req) => {
          commit('updateCategory', req.data.data)
        })
        .catch(() => {
          // todo: Make error model for display error
        })
    }
  }
}
