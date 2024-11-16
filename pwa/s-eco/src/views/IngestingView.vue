<script setup>
  import DependantRepositoryData from '../data/dependant-repository.json'
</script>

<template>
  <main>
    <div class="container  text-center mt-5 mb-5">
      <h1 class="mt-5">Ingesting</h1>
    </div>
    <div class="container">
    <table class="table table-resposive">
      <tr v-for="item in DependantRepositoryData" :key="item.id">
        <td>{{ item.id }} </td><td>{{ item.repository }}</td><td>{{ item.starred }} </td><td>{{ item.fork }}</td>
      </tr>
    </table>
  </div>
  </main>
</template>

<style>
</style>
