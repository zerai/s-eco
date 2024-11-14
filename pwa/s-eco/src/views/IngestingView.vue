<script setup>
  import DependantRepositoryData from '../data/dependant-repository.json'


</script>

<template>
  <div class="ingesting">
    <h1>This is an ingesting page</h1>

    <!-- {{ DependantRepositoryData }} -->

    <!-- <table style="{border:1}"> -->
    <table style=" background-repeat:no-repeat; width:450px;margin:0;" cellpadding="0" cellspacing="0" border="1">
      <tr v-for="item in DependantRepositoryData" :key="item.id">
        <td>{{ item.id }} </td><td>{{ item.repository }}</td><td>{{ item.starred }} </td><td>{{ item.fork }}</td>
      </tr>
    </table>

  </div>
</template>

<style>
@media (min-width: 1024px) {
  .ingesting {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
