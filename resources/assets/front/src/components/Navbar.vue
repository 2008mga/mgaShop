<template>
    <div class="docbar" ref="docBar">
        <div class="bg-white py-1">
            <div class="container-fluid justify-content-between d-flex align-items-center flex-wrap">
                <router-link :to="{ name: 'Home' }"
                             tag="div"
                             class="pl-md-4 logo">Mga shopper</router-link>
                <div class="d-flex pr-md-4">
                    <input type="text" class="px-3" placeholder="Введите название продукта">
                    <button class="btn btn-outline-primary">Поиск</button>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                Категории
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <router-link :to="{ name: 'Category', params: { id: category.id } }"
                                             class="dropdown-item"
                                             v-for="(category, key) in categories" :key="key">
                                    {{ category.name }}
                                    <span v-if="'num_of_products' in category">{{ category.num_of_products }}</span>
                                    <span v-else>0</span>
                                </router-link>
                            </div>
                        </li>

                    </ul>
                    <div class="navbar-nav ml-auto" v-if="!auth">
                        <a data-toggle="modal" data-target="#signIn"
                                     class="nav-item nav-link">Войти</a>
                        <a data-toggle="modal" data-target="#signUp"
                           class="nav-item nav-link">Регистрация</a>
                    </div>
                    <div class="navbar-nav ml-auto" v-if="auth && user.bag">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <div class="d-flex align-items-center flex-wrap">
                                    <a class="nav-link dropdown-toggle"
                                       href="#"
                                       id="navbarDropdownMenuLink"
                                       data-toggle="dropdown"
                                       aria-haspopup="false" aria-expanded="false">
                                        {{ user.name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#">Избранное</a>
                                        <a class="dropdown-item" href="#" @click="logout()">Выйти</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <a href="" class="nav-item nav-link">
                            <icon name="shopping-bag" />
                            ( {{ user.bag.length }} )
                            Корзина
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <modal id="signIn" v-if="!auth" :footer="false">
            <div slot="header">Войти</div>
            <auth mode="signIn"/>
        </modal>
        <modal id="signUp" v-if="!auth" :footer="false">
            <auth mode="signUp"/>
        </modal>
    </div>
</template>

<script>
import { mapActions, mapState } from 'vuex'
import Auth from '@/pages/Auth'
import Modal from '@/components/Modal'

export default {
  name: 'navbar',
  computed: {
    ...mapState('categoryModule', {
      categories: state => state.categories
    }),
    ...mapState('userModule', {
      auth: state => state.auth,
      user: state => state.info,
      bag: state => state.bag
    })
  },
  mounted () {
    this.loadCategories()

    window.onscroll = () => {
      const scrolled = window.pageYOffset || document.documentElement.scrollTop
      this.$root.$emit('docbar', {
        padding: this.$refs.docBar.offsetHeight,
        scrolled,
        ref: this.$refs.docBar
      })
    }
  },
  methods: {
    ...mapActions('categoryModule', [
      'loadCategories'
    ]),
    ...mapActions('userModule', [
      'logout'
    ])
  },
  components: {
    Auth,
    Modal
  }
}
</script>
