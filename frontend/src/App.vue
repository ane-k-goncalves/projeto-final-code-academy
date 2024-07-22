<script>
import { RouterLink, RouterView } from 'vue-router';
import AnimationVue from "./components/AnimationVue.vue";
 
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
  background: linear-gradient(to top, #f7f7f7 0%, #62aeff 200%);;
  height: 100vh;

}

/* .container{
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;

}

.btn {
    background-color: #FFB534;
    display:inline;
    justify-content: space-between;
    margin: 10px;
    margin-left: 50px;

}





main {
  margin-top: 100px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  flex: 1;
  width: 100%; 
} */









</style>
