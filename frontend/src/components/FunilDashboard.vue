<script>
 import { createFunil, updateFunil } from '../services/Funil';
import { mapActions, mapGetters } from 'vuex';
import { Modal } from 'bootstrap';

export default {

  name: 'FunilDashboard',
    data() {
      return {
        name: '',
        newName: '',
        id: ''
       
      }
    },
  methods: {
   
    showModal() {
        const modalElement = document.getElementById('adicionar');
        const modal = new Modal(modalElement);
        modal.show();
    },

    showModal2() {
        const modalElement = document.getElementById('editar');
        const modal = new Modal(modalElement);
        modal.show();
    },

    showModal3() {
        const modalElement = document.getElementById('excluir');
        const modal = new Modal(modalElement);
        modal.show();
    },


    async criarFunil() {
      const dados = {
        name: this.name,
        
      };

      try {
        const res = await fetch(`http://localhost:8000/api/register-funil`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    },
                    body: JSON.stringify(dados),
                });

          const data = await res.json();
        console.log(data);
        if (data) {
          alert('Cadastro realizado.');
          
        } else {
         
          console.error('Erro no registro:', data);
        }
      }catch(error){
        console.log('Erro', error);
      }
    },
    async editarFunil(){
      const dados = {
        name: this.newName,
        id: this.id,
      };
      try {
        const res = await fetch(`http://localhost:8000/api/register-funil`, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    },
                    body: JSON.stringify(dados),
                });

        const data = await res.json();
        
        if (res.ok) {
            if(this.id === this.name)
            this.name = this.newName;
          
          alert('Funil editado.');
          
        } else {
          console.error('Erro no registro:', data);
        }
      }catch(error){
        console.log('Erro', error);
      }
    },
    async excluirFunil(){
      const dados = {
        name: this.name,
       
      };
      try {
        const res = await fetch(`http://localhost:8000/api/register-funil`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    },
                    body: JSON.stringify(dados),
                });

        const data = await res.json();
        
        if (res.ok) {
          
          alert('Funil excluido.');
          
        } else {
          console.error('Erro no registro:', data);
        }
      }catch(error){
        console.log('Erro', error);
      }
  },
  }

}
</script>
<template>
    <div>
        <button type="button" class="btn" @click="showModal"> Adicionar novo funil</button>

        <div class="modal" id="adicionar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Funil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                <div class="modal-body">
                    <form @submit.prevent="criarFunil">
                    <div>
                    <label>Nome:</label>
                    <input v-model="name" type="text" />
                    </div>
                       
                
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                
                    </form>
                
                </div>
                </div>
            </div>
        </div>

        <!-- editar funil -->

        <button type="button" class="btn" @click="showModal2"> Editar funil</button>

        <div class="modal" id="editar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Funil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                <div class="modal-body">
                    <form @submit.prevent="editarFunil">
                    <div>
                    <label>Nome:</label>
                    <input v-model="name" type="text" />
                    </div>
                    <div>
                      <label>Novo nome:</label>
                    <input v-model="newName" type="text" />
                    </div>
                    
                
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                
                    </form>
                
                </div>
                </div>
            </div>
        </div>

        <!--Excluir-->
        <button type="button" class="btn" @click="showModal3"> Excluir funil</button>

        <div class="modal" id="excluir" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Funil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                <div class="modal-body">
                    <form @submit.prevent="excluirFunil">
                    <div>
                    <label>Nome:</label>
                    <input v-model="name" type="text" />
                    </div>
                    
                    
                
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                
                    </form>
                
                </div>
                </div>
            </div>
        </div>


     </div>
      
  </template>
  

  