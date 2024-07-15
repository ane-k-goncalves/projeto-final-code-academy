<script>
import ExcluirEtapa from './ExcluirEtapa.vue';
import EditarEtapa from './EditarEtapa.vue';

export default {
    name: 'CardsEtapas',
   
    props: {
        id: {
            type: Number,
            required: true
        },
        etapas: {
            type: Array,
            required: true
        },
    },
    // data() {
    //     return {
    //     etapas: []
    //     }
    // },
    components: {
        ExcluirEtapa,
        EditarEtapa
    }
   
}
</script>
<template>
      <div class="container">
         <div class="row">
            <div v-for="etapa in etapas" :key="etapa.id" :id="id" class="card text-center">
            <div class="card-body">
                <div class="container-body">
                    <div class="row">
                        <div class="col">
                    <h5 class="card-title">{{ etapa.name }}  </h5>
                    </div>
                    <div class="col">
                    <ExcluirEtapa :etapas="etapa.id" :id="id"/>
                    </div>
                   
                    <EditarEtapa :etapas="etapa.id" :id="id"/>
                    
                    </div>
                </div>
                </div>
                </div>
        </div>
    </div>
</template>
<style scoped>
.container {
    display: flex;
    justify-content: center;
    margin-top: 100px
}

.card{
    width: 280px;
    margin: 20px;
}

.container-body {
    display: inline;
    justify-content: space-between;

}

</style>