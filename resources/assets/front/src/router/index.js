import Vue from 'vue'
import Router from 'vue-router'
import Auth from '@/pages/Auth'
import Category from '@/pages/Category'
import Product from '@/pages/Product'

Vue.use(Router)

const $router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Home'
    },
    {
      path: '/auth',
      redirect: { name: 'Auth.SignIn' }
    },
    {
      path: '/auth/signIn',
      name: 'Auth.SignIn',
      component: Auth,
      props: {
        mode: 'signIn'
      },
      meta: { auth: false }
    },
    {
      path: '/auth/signUp',
      name: 'Auth.SignUp',
      component: Auth,
      props: {
        mode: 'signUp'
      },
      meta: { auth: false }
    },
    {
      path: '/category/:id',
      name: 'Category',
      component: Category
    },
    {
      path: '/product/:id',
      name: 'Product',
      component: Product
    }
  ]
})

export default $router
