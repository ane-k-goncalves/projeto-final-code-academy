<script>
import CardFunil from './CardFunil.vue';
import FunilDashboard from './FunilDashboard.vue';


export default {
    components: {
        CardFunil,
        FunilDashboard
    },
    data() {
        return {
            funis: {
                data:[],
                filter: '',
                perPage: 8,
                currentPage: 1,
    
            },
            funils: {},
            filtro: ''
         };
        },
        
        computed: {
            VisibleCard(){
                const startPage = (this.currentPage -1) * this.funis.perPage;
                const endPage = startPage + this.perPage;

                return this.funis.data.slice(startPage, endPage)
            },

            totalPages() {
                return Math.ceil(this.funis.data.lengh / this.perPage)
            },
           
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
                    if(page >=1 <= this.totalPages){
                        this.currentPage = page;
                        this.fetchFunis();
                    }
            },

            async buscar() {
                const params = new URLSearchParams({
                    filter: this.filtro,
                }).toString();
                const url = `http://localhost:8000/api/register-funil?${params}`;

                try {
                    const res = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    });
               

                    if(res.ok){
                        const data = await res.json();
                        this.funis.filter = data;
                        this.funis.currentPage = 1;
                    
                    }
            }catch(error){
                console.log(error);
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

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <FunilDashboard />
                        </a>
                    </li>
                
                </ul>
                <form class="d-flex">
                    <div class="filtro">
                        <input v-model="filtro" class="form-control me-2" type="search" placeholder="Search" @input="fetchFunis(1)"  aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" @click="buscar">Buscar</button>
                    </div>
                </form>
                </div>
            </div>
            </nav>
     
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

.navbar {
  height: 80px;
  margin-left: 100px;

}

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
.filtro {
    display: flex;
    justify-content: center;
}

input {
    width: 300px;
}
</style>