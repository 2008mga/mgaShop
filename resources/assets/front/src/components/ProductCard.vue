<template>
    <div class="product_card">
        <div class="image">
            <slot name="image"></slot>
        </div>
        <div class="title">
            <slot name="title"></slot>
        </div>
        <div class="footer d-flex flex-row justify-content-between align-items-center">
            <div class="price text-muted">
                <slot name="price"></slot>
            </div>
            <div>
                <router-link :to="{ name: 'Product', params: { id: this.product_id } }"
                             tag="button"
                             class="btn btn-sm btn-outline-secondary btn-about">></router-link>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  name: 'productCard',
  props: {
    product_id: {
      default: null
    }
  }
}
</script>
