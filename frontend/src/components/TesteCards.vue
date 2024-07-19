<script>
import draggable from 'vuedraggable';
import CardsEtapas from '../components/CardsEtapas.vue';
import EtapasFunil from '@/components/EtapasFunil.vue';

export default {
    components: {
        CardsEtapas,
        draggable,
        EtapasFunil
    },
    data() {
        return {
            drag: false,
            cardEtapas:[]
          }
    },
    props: {
    id: {
      type: Number,
      required: true,
    },
    etapas: {
      type: Array,
      required: true,
    },
  },
  

}
</script>
<template>
    <div>
    <!-- <draggable v-model="etapa" group="etapas" item-key="id" class="card text-center">
        <template #item="{ element: etapas }">
            <CardsEtapas v-for="etapa in etapas" :key="etapa.id" :id="id" class="card text-center"/>
                

        </template>
    </draggable> -->
    
    <draggable v-model="cardEtapas" group="etapas" item-key="id" class="card text-center">
            <template #item="{ element: etapa }">
                <div :key="etapa.id" class="card text-center">
                    <CardsEtapas :etapas="etapas" :id="id" />
                </div>
            </template>
        </draggable>
    </div>
</template>
<style scoped>

</style>