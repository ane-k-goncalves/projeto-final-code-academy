<script>
import { RouterLink, RouterView } from 'vue-router';
import AnimationVue from "./components/AnimationVue.vue";
import Cookie from 'js-cookie';
 
export default {
    name: "CRM" ,
      components: { 
          AnimationVue
     },
}

</script>

<template>
  <div id="app">
        <RouterView />  
  </div>
</template>

<style scoped>



#app {
  background:  #f5f5ff ;
  height: 100vh;
  

}


</style>
