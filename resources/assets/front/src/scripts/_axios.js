import axios from 'axios'

export const Axios = (baseURL, timeout, headers) => {
  return axios.create({
    baseURL,
    timeout,
    headers
  })
}
