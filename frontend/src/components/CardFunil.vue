<script>
import EditarFunil from './EditarFunil.vue';
import ExcluirFunil from './ExcluirFunil.vue';

export default {
    name: "CardFunil",
    data() {
        return {
            name:''
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
        <h1 v-for="funil in funils" :key="funil.name">{{ funil.name }} </h1>
        <!-- implementar listar funis e fazer por meio do v-for criar um card para cada -->
        <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{ name }} Nome funil </h5>
            
            <div> 
                <EditarFunil />
            </div>
            <div> 
                <ExcluirFunil />
            </div>
            <!-- Como fazer para editar e excluir herdar id  -->
        </div>
        </div>
    </div>

</template>
<style scoped>

</style>