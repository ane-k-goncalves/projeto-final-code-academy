<script>
import EditarFunil from './EditarFunil.vue';
import ExcluirFunil from './ExcluirFunil.vue';


export default {
    name: "CardFunil",
    props: {
        funils: {
            type: Object,
            required: true
        },
        
    },

    components: {
        EditarFunil,
        ExcluirFunil,
       
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
                <EditarFunil :id="funil.id"/>
            </div>
            <div> 
                <ExcluirFunil :id="funil.id" />
            </div>
           
        </div>
        </div>
    
    </div>
   

</div>

</template>
<style scoped>
.card {
   margin: 20px;
    width: 300px;

}

.col {
    display: flex;
    flex-wrap: wrap;
}
</style>