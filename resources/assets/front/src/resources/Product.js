import { Api } from '@/scripts/_api'

export default {
  get (id) {
    return Api().get('/products/' + id)
  }
}
