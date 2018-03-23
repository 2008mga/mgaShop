// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import { Api } from '@/scripts/_api'
import UserResource from '@/resources/User'
import Category from '@/resources/Category'
import Product from '@/resources/Product'
import { store } from '@/store'
import VueLocalStorage from 'vue-localstorage'
import Icon from 'vue-awesome/components/Icon'
/*
* import icons
* */

import 'vue-awesome/icons/user'
import 'vue-awesome/icons/shopping-bag'

// filters
import { relativeTime } from '@/scripts/_filters'

import '~/boot.scss'
/*
* import main styles
* */
import '@/scripts/_bootstrap'

Vue.config.productionTip = false

Vue.use(VueLocalStorage)

/*
* Configure for api
* */

const ApiResources = {
  'category': Category,
  'product': Product
}

/*
* Configure filters
* */
const filters = [
  {
    name: 'relativeTime',
    filter: relativeTime
  }
]

filters.forEach(function (filter) {
  Vue.filter(filter.name, filter.filter)
})

/*
* Middleware
* */
router.beforeEach((to, from, next) => {
  store.dispatch('userModule/me')
  const auth = store.state.userModule.auth

  if (to.matched.some(record => record.meta.auth)) {
    if (!auth) {
      return next({
        to: { name: 'Auth.SignIn' }
      })
    }
  }

  if (to.matched.some(record => record.meta.auth === false)) {
    if (auth) {
      return next('/')
    }
  }

  return next()
})

Vue.component('icon', Icon)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  data () {
    return {
      Api,
      UserResource,
      ApiResources
    }
  },
  components: { App },
  template: '<App/>',
  created () {
    console.log(this.$refs)

    this.$root.$on('docbar', (meta) => {
      this.$nextTick(() => {
        if (meta) {
          const body = document.getElementsByTagName('body')[0]
          const computedPadding = meta.padding + 'px'
          if (meta.scrolled > meta.padding + 50 && body.style.paddingTop !== computedPadding) {
            body.style.paddingTop = computedPadding
            meta.ref.style.position = 'fixed'
          } else if (meta.scrolled < meta.padding) {
            meta.ref.style.position = 'relative'
            body.style.paddingTop = '0px'
          }
        }
      })
    })
  }
})
