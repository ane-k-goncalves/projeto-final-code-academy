<script>
import EditarFunil from './EditarFunil.vue';
import ExcluirFunil from './ExcluirFunil.vue';

export default {
    name: "CardFunil",
    props: {
        funils: {
            type: Array,
            required: true
        }
    },
    
    
    components: {
        EditarFunil,
        ExcluirFunil
    },
 
                    
            }
    

</script>
<template>
    <div>
    <div class="col">
        
        <div  v-for="funil in funils" :key="funil.id" class="card text-center">
        <div class="card-body">
            <h5 class="card-title">{{ funil.name }}</h5>
            
            <div> 
                <EditarFunil />
            </div>
            <div> 
                <ExcluirFunil />
            </div>
           
        </div>
        </div>
    
    </div>


</div>

</template>
<style scoped>
.card {
   margin: 20px;
    width: 200px;

}

.col {
    display: flex;
    flex-wrap: wrap;
}
</style>