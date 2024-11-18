<script setup>
  import { ref } from 'vue';
  import DependantRepositoryData from '../data/dependant-repository.json'
  import { useIngestionStore } from '../stores/ingestionStore'

  const ingestionStore = useIngestionStore();

  ingestionStore.getData();
</script>

<template>
  <main>
    <div class="container  text-center mt-5 mb-5">
      <h1 class="mt-5">Ingesting</h1>
    </div>
    <div class="container">
      <table class="table table-resposive">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Dependant</th>
            <th scope="col">Repository</th>
            <th scope="col">Starred</th>
            <th scope="col">Fork</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in ingestionStore.dataItems" :key="item.id">
            <td>{{ item.id }} </td><td>{{ item.dependantFrom }}</td><td>{{ item.repository }}</td><td>{{ item.starred }} </td><td>{{ item.fork }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</template>

<style>
</style>
