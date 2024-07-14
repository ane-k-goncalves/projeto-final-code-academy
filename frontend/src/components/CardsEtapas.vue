<script>
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
   
}
</script>
<template>
      <div class="container">
         <div class="row">
            <div v-for="etapa in etapas" :key="etapa.id" :id="id" class="card text-center">
            <div class="card-body">
                <h5 class="card-title">{{ etapa.name }}</h5>
                
                
                </div>
                </div>
        </div>
    </div>
</template>
<style scoped>
.container {
    display: flex;
    justify-content: center;
    margin-top: 200px
}

.card{
    width: 200px;
    margin: 20px;
}

</style>