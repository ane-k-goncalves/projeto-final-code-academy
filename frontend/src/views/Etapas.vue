<script>
import NavBar from "@/components/NavBar.vue";
import EtapasFunil from "../components/EtapasFunil.vue";
// import CardsEtapas from "../components/CardsEtapas.vue";
import EditarEtapa from "@/components/EditarEtapa.vue";
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
    EditarEtapa,
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
      etapas: [],
      contatos: [],
      selectedEtapa: null,
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

      const etapa_id = this.etapas[oldIndex].id;
      const newPosition = newIndex;

      this.etapas.forEach((etapa, index) => {
        etapa.position = index;
      });

      console.log(etapa_id, newPosition);
      const dados = {
        etapaId: etapa_id,
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
          alert("Etapas trocadas");
          this.fetchEtapas();
        }
      } catch (error) {
        console.log(error);
        alert("Ocorreu um erro ao trocar as posições das etapas.");
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
            <li class="nav-item">
              <a class="nav-link" href="#">
                <EtapasFunil :etapas="etapas" :id="id" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <!-- <CrudContato /> -->
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="contato"></div>

    <div class="container">
      <draggable id="display" v-model="etapas" item-key="id" @end="onDragEnd">
        <template #item="{ element }">
          <div :key="element.id" class="card text-center">
            <div class="card-body">
              <div class="container-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title">{{ element.name }}</h5>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <!-- Example single danger button -->
                    <!-- <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></button>
                            <ul class="dropdown-menu">
                               <li> <CrudEtapas :element="element.id" :etapas="etapas.id" :id="id"/></li> -->
                    <!-- <li><a class="dropdown-item" href="#">  <CriarContato /></a></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                          </div> -->

                    <CriarContato :element="element.id" :id="id" />
                    <CrudEtapas
                      :element="element.id"
                      :etapas="etapas.id"
                      :id="id"
                    />
                    <!-- <CrudContato  :element="element.id" :id="id"/> -->
                  </div>
                  <div class="col">
                    <CardContato :element="element.id"  />
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

.card {
  width: 280px;
  margin: 10px;
  height: 600px;
  background-color: #f0f4fa;
}

.container-body {
  display: inline;
  justify-content: space-between;
}
</style>