<script>
import CardFunil from './CardFunil.vue';
import FunilDashboard from './FunilDashboard.vue';
import Cookie from 'js-cookie';

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
                total:''
    
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
           
            async changePage(page) {
                    if(page >=1 <= this.totalPages){
                        this.currentPage = page++;
                        this.fetchFunis();
                    }
            },

            async buscar() {
                const params = {
                    filter: this.filtro,
                }
                const url = `http://localhost:8000/api/register-funil`;

                try {
                    const res = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer  ${Cookie.get('token')}`,
                    },

                    body: JSON.stringify(params)
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
        // mounted() {
        //     this.fetchFunis();
        // }

}    

</script>
<template>
    <div>
        
             
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