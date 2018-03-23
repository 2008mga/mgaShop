<template>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <slot name="header"/>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot/>
                </div>
                <div class="modal-footer" v-if="footer">
                    <slot name="footer"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'modal',
  props: {
    buttonSave: {
      type: String,
      default: 'Сохранить'
    },
    buttonClose: {
      type: String,
      default: 'Закрыть'
    },
    footer: {
      type: Boolean,
      default: true
    }
  }
}
</script>
