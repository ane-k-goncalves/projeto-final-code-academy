<template>
  <div id="container" class="container d-flex justify-content-around align-items-start flex-wrap">
    <div class="caixas card">
      <h1 class="card-header sticky-top bg-white">Favorite Foods</h1>
      <draggable v-model="favoriteMeals" tag="ul" group="foods" :animation="300" class="list-group list-group-flush">
        <template #item="{ element: meal }">
          <li class="list-group-item">{{ meal }}</li>
        </template>
      </draggable>
    </div>  
    <div class="caixas card">
      <h1 class="card-header sticky-top bg-white">Terrible Foods</h1>
      <draggable v-model="terribleMeals" tag="ul" group="foods" :animation="300" class="list-group list-group-flush">
        <template #item="{ element: meal }">
          <li class="list-group-item">{{ meal }}</li>
        </template>
      </draggable>
    </div> 
    <div class="caixas card">
      <h1 class="card-header sticky-top bg-white">Healthy Foods</h1>
      <draggable v-model="healthyMeals" tag="ul" group="foods" :animation="300" class="list-group list-group-flush">
        <template #item="{ element: meal }">
          <li class="list-group-item">{{ meal }}</li>
        </template>
      </draggable>
    </div> 
    <!-- <div class="caixas card">
      <h1 class="card-header sticky-top bg-white">Junk Foods</h1>
      <draggable v-model="junkMeals" tag="ul" group="foods" :animation="300" class="list-group list-group-flush">
        <template>
        </template>
      </draggable>
    </div>  -->
  </div>
</template>

<script setup>
import { ref } from 'vue';
import draggable from 'vuedraggable';



const favoriteMeals = ref([
  'Pizza',
  'Sushi',
  'Pasta'
]);

const terribleMeals = ref([
  'Bat wing soup',
  'Spicy Octopus',
  'Anything from Taco Bell'
]);

const healthyMeals = ref([
  'Salad',
  'Smoothie',
  'Grilled Chicken'
]);

const junkMeals = ref([
  'Chips',
  'Candy',
  'Soda'
]);
</script>

<style scoped>
.caixas {
  max-height: 300px;
  overflow-y: auto;
  margin-bottom: 20px;
}
</style>
