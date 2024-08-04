<script>
import { Offcanvas } from "bootstrap";
import Cookie from "js-cookie";
import { Modal } from "bootstrap";

export default {
  name: "CrudEtapas",
  components: {},
  data() {
    return {
      newName: "",
      idExcluir: "modal" + this.element,
      idcrudet: "canv" + this.element,
      
    };
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
    element: {
      type: Array,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
  },
  methods: {
    show() {
      const myOffcanvas = document.getElementById(this.idcrudet);
      const bsOffcanvas = new Offcanvas(myOffcanvas);
      bsOffcanvas.show();
    },
    showModal() {
      const modalElement = document.getElementById(this.idExcluir);
      const modal = new Modal(modalElement);
      modal.show();
    },

    async editarEtapa() {
      const dados = {
        name: this.newName,
      };

      try {
        const res = await fetch(
          `http://localhost:8000/api/funis/${this.id}/etapas/${this.element}`,
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
        if (res.ok) {
          alert("Etapa editada");
          location.reload();
        
        }
      } catch (error) {
        console.log(error);
      }
    },
    async excluirEtapa() {
      try {
        const res = await fetch(
          `http://localhost:8000/api/funis/${this.id}/etapas/${this.element}`,
          {
            method: "DELETE",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
              Authorization: `Bearer  ${Cookie.get("token")}`,
            },
          }
        );
        if (res.ok) {
          alert("Etapa Excluída");
          location.reload();
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
<template>
  <div>
    <button
      class="btn"
      type="button"
      data-bs-toggle="offcanvas"
      :data-bs-target="'#' + idcrudet"
      aria-controls="idcrudet"> Editar</button>

    <div class="offcanvas offcanvas-end"
      tabindex="-1"
      :id="idcrudet"
      aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Etapa {{ element.name }}</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close" ></button>
      </div>
      <div class="offcanvas-body">
        
        <div class="card">
          <div class="card-header">Editar etapa</div>
          <div class="card-body">
            <form @submit.prevent="editarEtapa()">
              <div>
                <label>Novo nome:</label>
                <input v-model="newName" type="text" />
              </div>
              <button type="submit" id="btncolor" class="btn">Salvar</button>
            </form>
          </div>
        </div>

        <div class="offcanvas-footer" >
        <button type="submit" class="btn "  id="dd" @click="showModal">
          <svg xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            fill="currentColor"
            class="bi bi-trash3"
            viewBox="0 0 16 16">
            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
          </svg>
        </button>

        <div class="modal"
          :id="idExcluir"
          tabindex="-1"
          data-bs-backdrop="false" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Excluir Funil</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="excluirEtapa">
                  <p>Deseja mesmo excluir ?</p>

                  <button type="button" class="btn" id="btn-a" data-bs-dismiss="modal">
                    Cancelar
                  </button>
                  <button type="submit" class="btn" id="btn-b">Excluir</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>



      </div>
    </div>
  </div>
</template>
<style scoped>

.offcanvas-header {
  display: flex;
  justify-content: space-between;
}

.offcanvas-footer {
 margin-top: 450px;
}

.offcanvas {

  width: 500px;
}

label {
  margin-top: 20px;
}

input {
    box-sizing: border-box;
    border: 2px solid #eeeded;
    border-radius: 4px;
    margin-top: 20px;
    margin-bottom: 20px;
    width: 400px;
    height: 40px;
    
}

.btn {
  background-color: #FFBD00;
  color: white;
  width: 100px;
  height: 40px;
  
}

.modal-body {
  margin: 20px;
}
.modal-body button {
  margin: 10px;
}

.card {
  margin: 10px;
  width: 450px;
  display: flex;
  justify-content: center;
  border-color: #638cc6;
}

.card-header {
 
  display: flex;
  justify-content: center;
  background-color: #638cc6;
}

.card-body button {
  margin: 10px;
}

#btn-a {
    background-color: #E1E9F4;
    color: rgb(0, 0, 0);
    width: 150px;
    height: 40px;
}

#btn-b {
  background-color: #f23f2c;
    color: rgb(255, 255, 255);
    width: 150px;
    height: 40px;
}

#dd {
  width: 400px;
  background-color: #f23f2c;
}

#btncolor {
  background-color: #638cc6;
  width: 200px;
}


</style>