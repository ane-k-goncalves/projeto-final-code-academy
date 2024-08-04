<script>
import NavBar from "@/components/NavBar.vue";
import EtapasFunil from "../components/EtapasFunil.vue";
import Cookie from "js-cookie";
import { ref } from "vue";
import draggable from "vuedraggable";
import CrudEtapas from "@/components/CrudEtapas.vue";
import CriarContato from "@/components/CriarContato.vue";
import CrudContato from "@/components/CrudContato.vue";
import CardContato from "@/components/CardContato.vue";

export default {
  name: "Etapas",
  components: {
    NavBar,
    EtapasFunil,
    CrudEtapas,
    draggable,
    CriarContato,
    CrudContato,
    CardContato,
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
    
  },
  data() {
    return {
      filter: '',
      etapas: [],
      contatos: [],
      selectedEtapa: null,
    };
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
    async listarEtapas() {
      try {
        const res = await fetch(
          `http://localhost:8000/api/funis/${this.id}/etapas`,
          {
            method: "GET",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
              Authorization: `Bearer  ${Cookie.get("token")}`,
            },
          }
        );

        if (res.ok) {
          const data = await res.json();
          this.etapas = data.filter((etapa) => etapa.funil_id === this.id);
        }
      } catch (error) {
        console.log("Erro na requisição", error);
      }
    },

    async onDragEnd(evt) {
      const { newIndex, oldIndex } = evt;

       

      const etapa_id = this.etapas[newIndex].id;
      const newPosition = newIndex + 1;

      

      console.log(etapa_id, newPosition);
      const dados = {
       
        newPosition: newPosition,
      };


      
      try {
        const response = await fetch(
          `http://localhost:8000/api/funis/${this.id}/etapas/${etapa_id}/swap`,
          {
            method: "PUT",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
              Authorization: `Bearer  ${Cookie.get("token")}`,
            },

            body: JSON.stringify(dados),
          }
        );
        const result = await response.json();
        if (result.ok) {
          await this.listarEtapas();
        }
      } catch (error) {
        console.log(error);
        alert("Ocorreu um erro ao trocar as posições das etapas.");
      }
    },
  
    async buscarContato() {
      

      const url = `http://localhost:8000/api/etapas/${this.id}/contatos?ignoreEtapa=true&filter=${this.filter}`;
      
      try {
        const response = await fetch(
         url,
          {
            method: "GET",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
              Authorization: `Bearer  ${Cookie.get("token")}`,
            },

           
          }
        );
        const result = await response.json();
        if (response.ok) {
          this.contatos = result;  
        } else {
          console.error("Error:", result);
          alert("O contato não existe.");
        }
      } catch (error) {
        console.log(error);
        alert("O contato não existe.");
      }
    },

    },
    computed: {
    isFilterActive() {
      return this.filter.trim().length > 0;
    },
  },
  

  mounted() {
    this.listarEtapas();
    this.tokenExpirado();
  },
};
</script>
<template>
  <div>
    <NavBar />
    <nav class="navbar navbar-expand-lg navbar bg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> Funil {{ name }}</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item" id="naav">
              <a class="nav-link" href="#">
                <EtapasFunil :etapas="etapas" :id="id" />
              </a>
            </li>
          </ul>

          <form class="d-flex" @submit.prevent="buscarContato">
            <div class="filtro">
              <input v-model="filter" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
              <button class="btn " id="btncolor" type="submit">Buscar</button>
            </div>
          </form>
        </div>
      </div>
    </nav>
    <div class="contato"></div>
    
    <div class="container" v-if="!isFilterActive">
      
      <draggable id="display" v-model="etapas" item-key="id" @end="onDragEnd" group="etapa" ghost-class="hidden-ghost">
        <template #item="{ element }">
          <div :key="element.id" class="card text-center" id="cardedt">
            <div class="card-body">
              <div class="container-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title" id="titletop">{{ element.name }}</h5>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="head">
                      <CriarContato :element="element.id" :id="id" />
                      <CrudEtapas :element="element.id" :etapas="etapas.id" :id="id"/>
                    </div>
                  </div>
                  <div class="col">
                    <CardContato :element="element.id" :etapas="etapas" :id="id"  />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
      </draggable>
    </div>

    <div class="container" v-if="isFilterActive">
      <h3>Contatos</h3>

      <div v-if="contatos.length" class="buscar">
        <div v-for="contato in contatos" :key="contato.id" id="busca" class="card">
          <div class="card-body">
            <div class="card-header">
            <h4 class="card-title">{{ contato.name }}</h4>
            </div>
            <h5> Dados </h5>
            <p class="card-text">{{ contato.email }}</p>
            <p class="card-text">Valor: R${{ contato.valor }}</p>
            <p class="card-text">Endereço:{{ contato.endereco }}</p>
            
          </div>
        </div>
      </div>
    </div>
  
   
  </div>
</template>
<style scoped>
#cardedt{
  background-color: #f5f5ff;
  border-color: #f5f5ff ;
}

#titletop{
  border-top: 6px #7036e4 solid;
  
}




#btncolor {
  background-color: #3057f2;
  width: 100px;
} 


#btncolor :hover {
  background-color: #3057f2;
}

.hidden-ghost {
  opacity: 0.3;
}

.buscar {
  margin-top: 70px;
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  justify-content: center;
  
  max-width: 1500px;
  overflow-x: auto;
  
}

#naav {
  margin-left: 800px;
  display: inline;
  justify-content: flex-end;
}
 

h3 {
 
 display: inline;
 margin-left: 100px;
 width: 300px;
 height: 20px;

}

#busca{
  width: 300px;
  height: 250px;
  
}
.contato {
  margin-left: 100px;
}

.navbar {
  height: 80px;
  margin-left: 100px;
  width: 100wh;
}

.col {
  display: inline;
  justify-content: space-between;
}

.container {
  width: 100%;
  margin-left: 150px;
  margin-top: 50px;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  
  max-width: 1600px;
  overflow-x: auto;
}

#novo {
  width: 200px;
}
#display {
  display: flex;
  flex-wrap: nowrap;
}
.btn {
  background-color: #3057f2;
  color: white;
  width: 100px;
  height: 40px;
}

.nav-item {
  margin-left: 200px;
}

.card {
  width: 300px;
  margin: 10px;
  height: 700px;
  background-color: #f0f4fa;
  max-height: 700px;
  max-width: 300px;
  overflow-y: auto;
  
}

.container-body {
  display: inline;
  justify-content: space-between;
}

.head {
    display: flex;
    justify-content: space-between;
   
}

.filtro {
  width: 500px;
  display: flex;
  justify-content: space-between;
}



</style>