<template>
    <div class="auth">
        <template v-if="mode === 'signIn' || !mode">
            <div class="align-items-center justify-content-center">
                <div class="form-group form-group-sm">
                    <label for="username">Логин / Email</label>
                    <input type="text" v-model="fields.username"
                           name="username"
                           id="username"
                           class="form-control form-control-sm" />
                </div>
                <div class="form-group form-group-sm">
                    <label for="password">Пароль</label>
                    <input :type="(unsafe) ? 'text' : 'password'"
                           v-model="fields.password"
                           name="password"
                           id="password"
                           class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                    <input type="checkbox" class="mr-2" v-model="unsafe" id="unsafe" value="1">
                    <label for="unsafe">Показать пароль</label>
                </div>

                <button class="btn btn-sm btn-primary mr-3" @click="SignIn()">Войти</button>

            </div>
        </template>
        <template v-if="mode === 'signUp'">
            <div class="row flex-column align-items-center mb-5">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label for="username">Логин или Email</label>
                            <input type="text" v-model="fields.username"
                                   name="username"
                                   id="username"
                                   class="form-control form-control-sm" />
                        </div>
                        <div class="col-md-12">
                            <label for="password">Пароль</label>
                            <input :type="(unsafe) ? 'text' : 'password'"
                                   v-model="fields.password"
                                   name="password"
                                   id="password"
                                   class="form-control form-control-sm" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="mr-2" v-model="unsafe" id="unsafe" value="1">
                    <label for="unsafe">Показать пароль</label>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="lastName">Фамилия</label>
                            <input id="lastName"
                                   type="text"
                                   name="lastName"
                                   v-model="fields.lastName"
                                   class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label for="name">Имя</label>
                            <input id="name"
                                   type="text"
                                   name="name"
                                   v-model="fields.name"
                                   class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <a @click="HasSecondName()" href="#" class="d-block my-2">
                    <span v-if="!fields.hasSecondName">+</span>
                    <span v-if="fields.hasSecondName">-</span>
                    Добавить отчество
                </a>

                <button class="btn btn-sm btn-primary mr-3">Создать</button>
                <router-link :to="{ name: 'Auth.SignIn' }">Войти на сайт</router-link>

            </div>
        </template>
    </div>
</template>
<script>
import MaskedInput from 'vue-masked-input'

export default {
  name: 'Auth',
  props: ['mode'],
  data () {
    return {
      unsafe: false,
      countries: [],
      fields: {
        username: null,
        password: null,
        phone: null,
        postCode: null,
        name: null,
        lastName: null,
        secondName: null,
        hasSecondName: false,
        country: null
      }
    }
  },
  methods: {
    SignIn () {
      this.$store.dispatch('userModule/login', {
        username: this.fields.username,
        password: this.fields.password
      })
    },
    HasSecondName () {
      this.fields.hasSecondName = !this.fields.hasSecondName
    },
    GetCountriesList () {
      this.$root.Api()
        .get('https://restcountries.eu/rest/v2/lang/ru')
        .then((response) => {
          this.countries = response.data
        })
    }
  },
  components: {
    MaskedInput
  },
  mounted () {
    this.GetCountriesList()
  }
}
</script>
