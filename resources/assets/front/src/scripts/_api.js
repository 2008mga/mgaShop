import { Axios } from '@/scripts/_axios'
import Vue from 'vue'
import VueLocalStorage from 'vue-localstorage'

Vue.use(VueLocalStorage)

export function Api () {
  const baseURL = process.env.API_URL
  const auth = Vue.localStorage.get('auth')

  let headers = {}

  if (auth) {
    headers['Authorization'] = 'Bearer ' + auth
  }

  return Axios(
    baseURL,
    10000,
    headers
  )
}
