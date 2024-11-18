<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <div class="container">
    <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
      <RouterLink :to="{ name: 'home' }" class="navbar-brand">S-eco</RouterLink>
      <ul class="nav nav-pills">
<!--         <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link">About</a></li> -->
        <li class="nav-item"><RouterLink :to="{ name: 'home' }" class="nav-link">Home</RouterLink></li>
        <li class="nav-item"><RouterLink :to="{ name: 'ingesting' }" class="nav-link">Ingesting</RouterLink></li>
        <li class="nav-item"><RouterLink :to="{ name: 'about' }" class="nav-link">About</RouterLink></li>
        <li class="nav-item"><RouterLink :to="{ name: 'robot' }" class="nav-link">Robot</RouterLink></li>
      </ul>
    </header>
  </div>
</template>