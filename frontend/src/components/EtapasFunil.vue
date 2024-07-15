<script>
import { Modal } from 'bootstrap';
export default {
    name: "EtapasFunil",
    props: {
        id: {
        type: Number,
        required: true
        },
        etapas: {
            type: Array,
            required: true
        },
    },

    data() {
        return {
          
            newEtapa: '',
            
            // etapas: []
        }
    },
    

    methods: {
        showModal() {
            const modalElement = document.getElementById('adicionar');
            const modal = new Modal(modalElement);
            modal.show();
        },

        async novaEtapa() {
            try{
            const etapasExistentes = this.etapas.length;
            const newPosition = etapasExistentes > 4 ? Math.max(...this.etapas.map(etapa => etapa.position)) + 1 : 1;
            
            const dados = {
                name: this.newEtapa,
                position : newPosition
            };
           
            const res = await fetch(`http://localhost:8000/api/funis/${this.id}/etapas`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                 },
                 body: JSON.stringify({ dados})
            });

            if(res.ok) {
                const data = await res.json();
                this.etapas.push(data); // Atualize a lista de etapas
                    this.newEtapa = ''
            }
        }catch(error){
            console.log(error)
        }
        },
    }
 
}
</script>
<template>
     <div>
        <button type="button" class="btn" @click="showModal"> Adicionar nova etapa</button>

        <div class="modal" id="adicionar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Etapa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                <div class="modal-body">
                    <form @submit.prevent="novaEtapa">
                    <div>
                    <label>Nomeie nova etapa:</label>
                    <input v-model="newEtapa" type="text" />
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