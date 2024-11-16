<script setup>
import { RouterView } from 'vue-router'
import Header from "./components/header/AppHeader.vue"
</script>

<template>
  <div class="col-lg-8 mx-auto p-4 py-md-5" >
    <Header />
    <RouterView />
  </div>
</template>

<style scoped>

</style>
