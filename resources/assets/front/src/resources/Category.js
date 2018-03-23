import { Api } from '@/scripts/_api'

export default {
  all () {
    return Api().get('/categories')
  },
  popular () {
    return Api().get('/categories/popular')
  },
  get (id) {
    return Api().get('/categories/' + id)
  },
  getByPage (id, page) {
    return Api().get('/categories/' + id + '?page=' + page)
  }
}
