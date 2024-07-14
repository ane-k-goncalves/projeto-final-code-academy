<script>
import NavBar from '@/components/NavBar.vue';
import FunilDashboard from '../components/FunilDashboard.vue';
import EditarFunil from '../components/EditarFunil.vue';
import ExcluirFunil from '../components/ExcluirFunil.vue';
import CardFunil from '../components/CardFunil.vue'
import Paginacao from '@/components/Paginacao.vue';

export default {
        components: {
          FunilDashboard,
          NavBar,
          EditarFunil,
          ExcluirFunil,
          CardFunil,
          Paginacao
        },
       
};
</script>
<template>
 

  <div>
    <NavBar />
    
  <div>
    <Paginacao />
  </div>

</div>
    
</template>
<style scoped>


</style>