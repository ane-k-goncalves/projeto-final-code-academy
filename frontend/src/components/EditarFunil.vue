<script>
import { Modal } from "bootstrap";

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

      console.log(this.id);
      try {
        const res = await fetch(
          `http://localhost:8000/api/register-funil/${this.id}`,
          {
            method: "PUT",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
            },
            body: JSON.stringify(dados),
          }
        );

        const data = await res.json();

        if (data.ok) {
          new alert("Funil editado.");
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
    <button type="button" class="btn" @click="showModal2">Editar funil</button>

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

              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Save changes
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.btn {
  background: #3057f2;
  color: white;

  margin: 10px;
}
</style>
