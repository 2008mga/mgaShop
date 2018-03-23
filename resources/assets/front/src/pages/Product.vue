<template>
    <div class="product" v-if="product">
        <h1>{{ product.name }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{ name: 'Home' }">Главная</router-link></li>

            <template v-if="'subcategory' in product.category && product.category.subcategory !== null">
                <li class="breadcrumb-item" v-for="(subcategory, index) in product.category.subcategory" :key="index">
                    <router-link :to="{ name: 'Category', params: { id: subcategory.id } }">Library</router-link>
                </li>
            </template>

            <li class="breadcrumb-item">
                <router-link :to="{ name: 'Category', params: { id: product.category.id } }">
                    {{ product.category.name }}
                </router-link>
            </li>
            <li class="breadcrumb-item active">
                {{ product.name }}
            </li>
        </ol>
        <div class="side-wrapper">
            <div class="side">
                <div class="image">
                    <img :src="(selectedImage) ? selectedImage : product.image" :alt="product.name">
                </div>
                <div class="images">
                    <div v-for="(image, index) in product.images"
                         :key="index"
                         @click="updateSelectedImage(image)"
                         :class="{ selected: selectedImage === image }"
                    >
                        <img :src="image" width="100%" />
                    </div>
                </div>
                <div class="actions">
                    <span>{{ product.price * selectedNum }}.руб</span>
                    <div class="nums">
                        <div class="arrow minus" @click="updateNum(selectedNum - 1)">-</div>
                        <input type="text" name="nums" v-model="selectedNum">
                        <div class="arrow plus" @click="updateNum(selectedNum + 1)">+</div>
                    </div>
                    <button class="btn btn-info btn-sm">В корзину</button>
                </div>
            </div>
            <div class="side">
                <div>
                    <h4 class="text-muted text-uppercase mb-4">Характеристики</h4>
                    <div class="table-responsive">
                        <table class="table characteristics">
                            <tbody>
                                <tr v-for="(characteristic, index) in product.characteristics" :key="index">
                                    <th>{{ characteristic.characteristic.name }}</th>
                                    <td>{{ characteristic.value }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="text-muted text-uppercase my-4">Описание</h4>
        <div>
            {{ product.description }}
        </div>

        <h4 class="text-muted text-uppercase my-4">Комментарии</h4>
        <div class="add-comment" v-if="auth">
            <textarea class="form-control"
                      placeholder="Напишите ваш отзыв по поводу продукта"
                      maxlength="300"
                      v-model="comment.data"
            ></textarea>
            <div class="my-3 d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    {{ (comment.data) ? comment.data.length : 0 }} / 300
                </div>
                <div class="text-danger" v-if="commentError" v-html="commentError"></div>
                <button class="btn btn-sm btn-outline-primary"
                    @click="commenting()">Отправить</button>
            </div>
        </div>
        <div class="comments">
            <comment-component
                    v-for="(comment, index) in product.comments"
                    :key="index"
                    :user="comment.user"
                    :comment="comment.comment"
                    :created_at="comment.created_at"
            />
        </div>
    </div>
</template>

<script>
import CommentComponent from '@/components/Comment'
import { mapState } from 'vuex'

export default {
  name: 'product',
  data () {
    return {
      selectedImage: null,
      selectedNum: 1,
      comment: {
        data: null,
        maxLength: 300
      }
    }
  },
  computed: {
    ...mapState('productModule', {
      product: state => state.loaded,
      commentError: state => state.comment.error
    }),
    ...mapState('userModule', {
      auth: state => state.auth
    })
  },
  methods: {
    getProduct (id) {
      this.$store.dispatch('productModule/load', id)
    },
    updateSelectedImage (image) {
      this.selectedImage = image
    },
    updateNum (num) {
      this.selectedNum = (num - 1 <= 0) ? 1 : num
    },
    commenting () {
      if (!this.comment.data) {
        return false
      }

      this.$store.dispatch('productModule/commenting', this.comment.data)
    }
  },
  watch: {
    '$router.params.id' (id) {
      this.getProduct(id)
    }
  },
  mounted () {
    this.getProduct(this.$route.params.id)
  },
  components: {
    CommentComponent
  }
}
</script>
