<script>
import NavBar from '@/components/NavBar.vue';
import FunilDashboard from '../components/FunilDashboard.vue';
import CardFunil from '../components/CardFunil.vue';
import Paginacao from '@/components/Paginacao.vue';
import Cookie from 'js-cookie';

export default {
  name: 'Dashboard',
  data() {
    return {
      funis: {
        data: [],
        filter: '',
        perPage: 8,
        currentPage: 1,
        total: 0,
      },
      filtro: '',
    };
  },
  components: {
    FunilDashboard,
    NavBar,
    CardFunil,
    Paginacao
  },
  methods: {
    async tokenExpirado()  {
        try {
        const response = await fetch(`http://localhost:8000/api/logout`, {
             method: 'POST',
             headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer  ${Cookie.get('token')}`,
            },
        });
        if (!response.ok) {
          alert('Sua sessão expirou. Por favor, faça login novamente.');
          this.$router.push('/login');
          
        }

      } finally {
       
        setTimeout(() => {
          this.tokenExpirado();
        }, 600000); 
      }
    
    },
    async fetchFunils(page = 1) {
      const token = Cookie.get('token');
      const url = `http://localhost:8000/api/register-funil?page=${page}&filter=${encodeURIComponent(this.filtro)}`;

      try {
        const res = await fetch(url, {
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`,
          }
        });

        if (res.ok) {
          const data = await res.json();
          this.funis.data = data.data;
          this.funis.total = data.total;
          this.funis.currentPage = data.current_page;
          this.funis.perPage = data.per_page;
         
        } else {
          console.error('Erro ao buscar funis');
        }
      } catch (error) {
        console.error('Erro na requisição', error);
      }
    },
    async buscar() {
      this.funis.currentPage = 1; 
      await this.fetchFunils();
    },
    handlePageChange(page) {
      this.funis.currentPage = page;
      this.fetchFunils(page);
    }
  },
  mounted() {
    this.fetchFunils();
    this.tokenExpirado();
  }
}
</script>

<template>
  <div>
    <NavBar />
    <nav class="navbar navbar-expand-lg navbar bg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item" id="naav">
              <a class="nav-link" href="#">
                <FunilDashboard />
              </a>
            </li>
          </ul>
          <form class="d-flex" @submit.prevent="buscar">
            <div class="filtro">
              <input v-model="filtro" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
              <button class="btn btn-outline" id="btncolor" type="submit">Buscar</button>
            </div>
          </form>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <CardFunil :funils="funis.data" />
      </div>
    </div>

    <div class="pag">
      <Paginacao :currentPage="funis.currentPage" :totalPages="Math.ceil(funis.total / funis.perPage)" @changePage="handlePageChange" />
    </div>
  </div>
</template>

<style scoped>

#btncolor {
  background-color: #3057f2;
  width: 100px;
  color: white;
} 


#btncolor :hover {
  background-color: #3057f2;
}

.navbar {
  height: 80px;
  margin-left: 100px;
  
}
#naav {
  margin-left: 800px;
  display: inline;
  justify-content: flex-end;
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
  width: 500px;
}

.filtro input {
  width: 500px;
}

input {
  width: 300px;
}

.pag {
 
}
</style>
