<template>
  <div id="app">
    <navbar />
    <div class="container mt-5">
      <transition name="fade" mode="out-in">
        <router-view :key="$route.path"/>
      </transition>
    </div>
  </div>
</template>

<script>
import navbar from '@/components/Navbar'

export default {
  name: 'App',
  components: {
    navbar
  }
}
</script>
