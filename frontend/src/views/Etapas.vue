<script>
import NavBar from "@/components/NavBar.vue";
import EtapasFunil from "../components/EtapasFunil.vue";
import CardsEtapas from "../components/CardsEtapas.vue";

export default {
  name: "Etapas",
  components: {
    NavBar,
    EtapasFunil,
    CardsEtapas,
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
    goToDashboard() {
      this.$router.push("/dashboard");
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
                <button class="btn" type="submit">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="currentColor"
                    class="bi bi-person-add"
                    viewBox="0 0 16 16"
                  >
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
            <li class="nav-item">
              <button class="btn-sair" type="submit" @click="goToDashboard">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="30"
                  height="30"
                  fill="currentColor"
                  class="bi bi-arrow-left"
                  viewBox="0 0 16 16"
                >
                  <path
                    fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"
                  />
                </svg>
              </button>
            </li>
          </ul>
          <form class="d-flex">
            <!-- <div class="filtro">
                        <input v-model="filtro" class="form-control me-2" type="search" placeholder="Search" @input="fetchFunis(1)"  aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" @click="buscar">Buscar</button>
                    </div> -->
          </form>
        </div>
      </div>
    </nav>

    <CardsEtapas :etapas="etapas" :id="id" />
  </div>
</template>
<style scoped>
.navbar {
  height: 80px;
  margin-left: 100px;
}

.btn {
  background-color: #3057f2;
  color: white;
  width: 200px;
  height: 40px;
}

.nav-item {
  margin-left: 200px;
}
</style>