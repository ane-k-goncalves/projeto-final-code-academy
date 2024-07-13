<script>
import { Modal } from 'bootstrap';
export default {
    name: 'ExcluirFunil',
    data() {
      return {
        // name: '',
        // newName: '',
        // id: ''
       
      }
    },
    props: {
    funils: {
            type: Object,
            required: true
        },
        id: {
            type: Number,
            required: true
        },
       
    },
     methods: {
        showModal3() {
            const modalElement = document.getElementById('excluir');
            const modal = new Modal(modalElement);
            modal.show();
        },
        async excluirFunil(){
        const dados = {
            name: this.name,
        
        };
        try {
            const res = await fetch(`http://localhost:8000/api/register-funil/${this.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                          
                        },
                        body: JSON.stringify(dados),
                    });

            const data = await res.json();
            
            if (res.ok) {
            
            alert('Funil excluído.');
            
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
                        <p> Deseja mesmo excluir ?</p>
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