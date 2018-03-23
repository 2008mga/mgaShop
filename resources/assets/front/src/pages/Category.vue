<template>
    <div class="category-wrapper" v-if="category">
        <h1>
            {{ category.name }}
        </h1>
        <p class="text-muted">{{ category.description }}</p>
        <small class="d-block">
            Товаров в этой категории {{ category.num_of_products }} шт.
        </small>
        <hr>
        <div class="products d-flex justify-content-center flex-wrap">
            <product-card :product_id="product.id" v-if="product" v-for="(product, index) in products" :key="index">
                <div slot="title">
                    {{ product.name }}
                </div>
                <div slot="image">
                    <img :src="product.image" width="100%"/>
                </div>
                <div slot="price">{{ product.price }}</div>
            </product-card>
        </div>
        <div class="paginate_separated">
            <button v-if="category.products_paginate.next_page_url"
                    class="btn btn-sm btn-secondary"
                    @click="loadNextPage(category.products_paginate.current_page + 1)">Загрузить ещё</button>
        </div>
    </div>
</template>

<script>
import productCard from '@/components/ProductCard'
import { mapState } from 'vuex'

export default {
  name: 'Category',
  computed: {
    ...mapState('categoryModule', {
      category: state => state.loaded,
      products: state => state.products
    })
  },
  watch: {
    '$route.params.id' (id) {
      this.getCategory(id)
    }
  },
  components: {
    productCard
  },
  methods: {
    loadNextPage () {
      this.$store.dispatch('categoryModule/nextPage')
    },
    getCategory (id) {
      this.$store.dispatch('categoryModule/load', id)
    }
  },
  mounted () {
    this.getCategory(this.$route.params.id)
  }
}
</script>
