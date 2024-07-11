<script>
import { Modal } from 'bootstrap';

export default {

  name: 'EditarFunil',
    data() {
      return {
        name: '',
        newName: '',
        id: ''
       
      }
    },
    methods: {
        showModal2() {
        const modalElement = document.getElementById('editar');
        const modal = new Modal(modalElement);
        modal.show();
    },
    async editarFunil(){
      const dados = {
        name: this.name,
        id: this.id,
      };
      try {
        const res = await fetch(`http://localhost:8000/api/register-funil/${this.id}`, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                       
                    },
                    body: JSON.stringify(dados),
                });

        const data = await res.json();
        console.log(data);
        if (data.ok) {
           
            this.name = this.newName;
          
          alert('Funil editado.');
            
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
                    <label>ID:</label>
                    <input v-model="id" type="text" />
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
    </div>
</template>
<style scoped>
.btn {
    background: #3057F2;
    color: white;
   
    margin: 10px;
    
}
</style>
