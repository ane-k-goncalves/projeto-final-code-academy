<script>
import NavBar from "@/components/NavBar.vue";
import EtapasFunil from "../components/EtapasFunil.vue";
import CardsEtapas from "../components/CardsEtapas.vue";
import EditarEtapa from "@/components/EditarEtapa.vue";
import Cookie from 'js-cookie';
import { ref } from 'vue';
import draggable from 'vuedraggable';
import CrudEtapas from "@/components/CrudEtapas.vue";

export default {
  name: "Etapas",
  components: {
    NavBar,
    EtapasFunil,
    CardsEtapas,
    EditarEtapa,
    CrudEtapas,
    draggable
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
      etapas: [],

      selectedEtapa1: null ,
      selectedEtapa1: null ,

    };
  },
  methods: {
    async listarEtapas() {
      try {
        const res = await fetch(
          `http://localhost:8000/api/funis/${this.id}/etapas`,
          {
            method: "GET",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
                'Authorization': `Bearer  ${Cookie.get('token')}`,
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

    setSelectedEtapa(etapaId) {
      if (!this.selectedEtapa1) {
        this.selectedEtapa1 = etapaId;
      } else {
        this.selectedEtapa2 = etapaId;
      }
    },
    async onDragEnd(evt) {
      const { newIndex, oldIndex } = evt;

      const etapa1Id = this.etapas[oldIndex].id;
      const etapa2Id = this.etapas[newIndex].id;

      console.log(etapa1Id, etapa2Id, )
      const dados = {
        etapa1_id: etapa1Id,
        etapa2_id: etapa2Id,
      }

      try {
        const response = await fetch(`http://localhost:8000/api/funis/${this.id}/etapas/swap`, {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
                'Authorization': `Bearer  ${Cookie.get('token')}`,
          },

          body: JSON.stringify(dados)
        });

        alert(response.data.message);
        this.fetchEtapas(); 
      } catch (error) {
        if (error.response && error.response.data) {
          alert(error.response.data.message);
        } else {
          alert('Ocorreu um erro ao trocar as posições das etapas.');
        }
      }
    },

  },
  mounted() {
    this.listarEtapas();
  },
};
</script>
<template>
  <div>
    <NavBar />
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> Funil {{ name }}</a>
        <button class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <EtapasFunil :etapas="etapas" :id="id" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <button class="btn" id="novo" type="submit">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="currentColor"
                    class="bi bi-person-add"
                    viewBox="0 0 16 16">
                    <path
                      d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"
                    />
                    <path
                      d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"
                    />
                  </svg>
                  Novo contato
                </button>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
      <div class="container">
        <draggable id="display" v-model="etapas" item-key="etapa.id" @end="onDragEnd">
          <template #item="{ element }">
          <div :key="element.id" class="card text-center">
            <div class="card-body">
                <div class="container-body">
                    <div class="row">
                      <div class="col">
                      <h5 class="card-title"> {{ element.name }} </h5> 
                      </div>
                      </div>

                      <div class="row">
                        <div class="col">
                            <CrudEtapas :element="element.id" :id="id"/>
                        </div>
                        <div class="col">
                            <button class="btn" id="c" @click="showModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                            </svg></button>
                        </div>
                      </div>
                    
                </div>
            </div>
          </div>
        </template>
        </draggable>
      </div>
     
  </div>
</template>
<style scoped>
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
  margin: 100px;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
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


.card{
    width: 280px;
    margin: 10px;
    height: 600px;
    background-color:#F0F4FA;
  
}

.container-body {
    display: inline;
    justify-content: space-between;

}

#c {
    background-color: #E1E9F4;
    
}
</style>