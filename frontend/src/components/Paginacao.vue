<script>
import CardFunil from './CardFunil.vue';

export default {

    props: {
            funils: {
            type: Object,
            required: true
        }
    },
    methods: {
        fetchFunils(url) {
            // Emite um evento para o componente pai (FunilDashboard.vue) para buscar os dados da página correspondente
            this.$emit('fetch-funils', url);
        }
    }
}
//     components: {
//         CardFunil
//     },
//     data() {
//         return {
//             funis: {
//                 data: [],
//                 prev_page_url: null,
//                 next_page_url: null,
//             },
//             filter: '',
//             perPage: 8,
//             currentPage: 1,
//          };
//         },
//         created() {
//         this.fetchFunis(this.currentPage);
//         },
//         methods: {
//             async fetchFunis(page) {
//             const params = new URLSearchParams({
//                 page,
//                 perPage: this.perPage,
//                 filter: this.filter,
//             });

    
//                 const res = await fetch(`http://localhost:8000/api/register-funil`, {
//                     method: 'GET',
//                     headers: {
//                         'Accept': 'application/json',
//                         'Content-Type': 'application/json',
                                    
//                 },
              
//                 });

//                 if(res.ok){
//                 this.funis = res.data;
//                 this.currentPage = page;
//                 }
//     }
//   },

    

</script>
<template>
         <!-- <div> -->
            <!-- <input v-model="filter" placeholder="Filter" @input="fetchFunis(1)" /> -->
            <!-- <div class="card-list">
                <CardFunil :funils="funis.data"  /> -->
             
            <div> 
            <button @click="fetchFunils(funis.prev_page_url)" :disabled="!funis.prev_page_url">Anterior</button>
            <button @click="fetchFunils(funis.next_page_url)" :disabled="!funis.next_page_url">Próximo</button>
          </div>
  
</template>
<style scoped>

</style>