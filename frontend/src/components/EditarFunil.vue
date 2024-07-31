<script>
import { Modal } from "bootstrap";
import Cookie from 'js-cookie';

export default {
  name: "EditarFunil",
  data() {
    return {
      newName: "",
      idModal: "modal" + this.id,
    };
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  methods: {
    showModal2() {
      const modalElement = document.getElementById(this.idModal);
      const modal = new Modal(modalElement);
      modal.show();
    },
    async editarFunil() {
      const dados = {
        name: this.newName,
      };
      try {
        const res = await fetch(
          `http://localhost:8000/api/register-funil/${this.id}`,
          {
            method: "PUT",
            headers: {
              'Accept': "application/json",
              "Content-Type": "application/json",
              'Authorization': `Bearer  ${Cookie.get('token')}`,
            },
            body: JSON.stringify(dados),
          }
        );

        const data = await res.json();

        if (data) {
         alert("Funil editado.");
        }
        else {
          alert("Erro ao editar funil");
        }
      } catch (error) {
        console.log("Erro", error);
      }
    },
  },
};
</script>
<template>
  <div>
    <button type="button" class="btn" @click="showModal2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
  </svg></button>

    <div class="modal" :id="idModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Funil</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>

          <div class="modal-body">
            <form @submit.prevent="editarFunil">
              <div>
                <label>Novo nome:</label>
                <input v-model="newName" type="text" />
              </div>

              <button type="button" id="btn-a" class="btn" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="btn-b" class="btn "> Salvar </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.btn {
  background:  #E1E9F4;
  color: rgb(0, 0, 0);
  width: 100px;
  margin: 10px;
}

input {
    box-sizing: border-box;
    border: 2px solid #eeeded;
    border-radius: 4px;
    margin: 10px;
    width: 340px;
    height: 40px;
    
}

.modal-body button { 
  margin-top: 30px;
  width: 200px;
}


#btn-a {
    background-color: #E1E9F4;
    color: rgb(0, 0, 0);
    width: 200px;
    height: 40px;
}

#btn-b {
    background-color: #3057f2;
    color: rgb(255, 255, 255);
    width: 200px;
    height: 40px;
}
</style>
