<script>
import { Modal } from 'bootstrap';

export default {
    name: "EditarEtapa",
    props: {
        id: {
        type: Number,
        required: true
        },
        etapas: {
            type: Array,
            required: true
        },
    data() {
        return {
            newName: '',
            idEditar: "modal " + this.etapas,
        }
    }
    }, 
    methods: {
        showModal2() {
            const modalElement = document.getElementById(this.idEditar);
            const modal = new Modal(modalElement);
            modal.show();
        },

        async editarEtapa() {
            const dados = {
                name: this.newName,
                
            };
            try{
            const res = await fetch(`http://localhost:8000/api/funis/${this.id}/etapas/${this.etapas}`,  {
                        method: 'PUT',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                          
                        },
                        body: JSON.stringify(dados),
                    });
                if(res.ok){
                 
                    alert('Etapa editada')
                }

            }catch(error) {
                console.log(error)
            }

        }
    }
}
</script>
<template>
    <div>
      <button type="button" class="btn" @click="showModal2"> Editar etapa</button>

        <div class="modal" :id="idEditar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar etapa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body">
                    <form @submit.prevent="editarEtapa">
                    
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

</style>