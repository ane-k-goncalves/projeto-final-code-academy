<script>
import CardFunil from './CardFunil.vue';


export default {

    // props: {
    //         funils: {
    //         type: Object,
    //         required: true
    //     }
    // },
//     methods: {
//         fetchFunils(url) {
//             // Emite um evento para o componente pai (FunilDashboard.vue) para buscar os dados da página correspondente
//             this.$emit('fetch-funils', url);
//         }
//     }
// // }
    components: {
        CardFunil
    },
    data() {
        return {
            funis: {
                data:[],
                filter: '',
                perPage: 8,
                currentPage: 1,
    
            },
            funils: {}
         };
        },
        
        computed: {
            VisibleCard(){
                const startPage = (this.currentPage -1) * this.perPage;
                const endPage = startPage + this.perPage;

                return this.funils.slice(startPage, endPage)
            }
        },
        methods: {
            async fetchFunis() {
           
            const res = await fetch(`http://localhost:8000/api/register-funil/`,{
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                                    
                     },
                    
                });

                if(res.ok){
                    const data = await res.json();
                    this.funis = data;
                }
            },
            async changePage(page) {
                    if(page >=1){
                        this.currentPage = page;
                        console.log(currentPage)
                    }
            }
        },
        mounted() {
            this.fetchFunis();
        }

}    

</script>
<template>
         <div>
         <!-- <input v-model="filter" placeholder="Filter" @input="fetchFunis(1)" /> 
           -->
         <div class="container">
          <div class="row">
            
            <CardFunil :funils="funis.data" :key="funils.id"  />
          </div>
         
        </div>

             
             
           <div class="page">  
                 <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" href="#" @click="changePage(currentPage -1)" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                        <a class="page-link" href="#" @click="changePage(funils.currentPage + 1)" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>
                    </ul>
                </nav>
            </div>
         </div>
</template>
<style scoped>

.container {
    display: flex;
    justify-content: center;
}

.row {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}

.page {
    display: flex;
    justify-content: center;
}
</style>