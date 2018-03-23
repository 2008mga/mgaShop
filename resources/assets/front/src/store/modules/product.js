import { Api } from '@/scripts/_api'

export default {
  namespaced: true,
  state: {
    loaded: null,
    comment: {
      error: null
    }
  },
  mutations: {
    updateProduct (state, product) {
      product.images = product.images.concat(product.image)
      state.loaded = product
    },
    appendComment (state, comment) {
      state.comment.error = null
      state.loaded.comments.unshift(comment)
    },
    errorComment (state, error) {
      state.comment.error = error
    }
  },
  actions: {
    load ({ commit }, id) {
      Api()
        .get('/products/' + id)
        .then((req) => {
          commit('updateProduct', req.data.data)
        })
    },
    commenting ({ commit, state }, comment) {
      Api().post('/products/' + state.loaded.id + '/commenting', { comment })
        .then((req) => {
          commit('appendComment', req.data.data)
        })
        .catch((err) => {
          if (err && err.response) {
            commit('errorComment', err.response.data.data)
          }
        })
    }
  }
}
