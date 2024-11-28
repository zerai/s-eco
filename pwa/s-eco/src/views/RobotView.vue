<script setup>
  import { ref } from 'vue';
  import { usePartsStore } from '../stores/partsStore'

  const partsStore = usePartsStore();

  partsStore.getParts();

</script>

<template>
  <main>
    <div class="container  text-center mt-5 mb-5">
      <h1 class="mt-5">Robot</h1>
    </div>
    {{ partsStore.parts }}
  </main>
</template>

<style>
</style>
