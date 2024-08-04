<script>
import { Modal } from "bootstrap";
import CardFunil from "./CardFunil.vue";
import Cookie from "js-cookie";

export default {
  name: "FunilDashboard",
  data() {
    return {
      name: "",
      newName: "",
      id: "",
      funils: [],
    };
  },
  
  components: {
    CardFunil,
  },
  methods: {
    showModal() {
      const modalElement = document.getElementById("adicionar");
      const modal = new Modal(modalElement);
      modal.show();
    },
    async criarFunil() {
      const dados = {
        name: this.name,
      };

      try {
        const res = await fetch(`http://localhost:8000/api/register-funil`, {
          method: "POST",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: `Bearer ${Cookie.get("token")}`,
          },
          body: JSON.stringify(dados),
        });

        if (res.ok) {
          alert("Funil cadastrado.");
          location.reload();
        } else {
          console.error("Erro no registro:", data);
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
    <button type="button" class="btn" id="btncolor" @click="showModal">Adicionar novo funil</button>
    <div class="modal" id="adicionar" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Funil</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>

          <div class="modal-body">
            <form @submit.prevent="criarFunil">
              <div>
                <label>Nome:</label>
                <input v-model="name" type="text" />
              </div>
              <div class="modal-footer">
              <button type="button" id="btn-a"
                class="btn "
                data-bs-dismiss="modal">Close
              </button>
              <button type="submit" id="btn-b" class="btn ">
                Save changes
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<style scoped>

#btncolor {
  background-color: #3057f2;
  width: 200px;
}

.container {
  margin: 80px;
}

button {
  background-color: blue;
  color: white;
  margin: 20px;
}

input {
    box-sizing: border-box;
    border: 2px solid #eeeded;
    border-radius: 4px;
    margin: 20px;
    width: 340px;
    height: 40px;
    
}

.modal-body {
    margin:10px;
}

.modal-footer {
  display: flex;
  justify-content: center;
  margin-bottom: 30px;

}

.modal-footer button { 
  margin: 5px;
  width: 200px;
}

.btn {
  background-color: #3057f2;
  color: white;
  width: 200px;
  height: 40px;
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
