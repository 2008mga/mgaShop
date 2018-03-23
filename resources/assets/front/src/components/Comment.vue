<template>
    <div class="comment">
        <div class="user d-flex justify-content-between">
            <span class="name text-muted">{{ user.name }}</span>
            <span class="date">{{ created_at | relativeTime }}</span>
        </div>
        <div class="comment_text">
            {{ comment }}
        </div>
    </div>
</template>

<script>
export default {
  name: 'comment',
  props: {
    user: {
      type: Object
    },
    comment: {
      type: String
    },
    created_at: {
      type: String
    }
  }
}
</script>
