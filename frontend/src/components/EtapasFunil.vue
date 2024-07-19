<script>
import { Modal } from 'bootstrap';
import Cookie from 'js-cookie';

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
            name: '',
            adicionar: "modal "+ this.etapas
        }
    },
    methods: {
        showModal() {
            const modalElement = document.getElementById(this.adicionar);
            const modal = new Modal(modalElement);
            modal.show();
        },

        async novaEtapa() {
            try{
            const etapasExistentes = this.etapas.length;
            const newPosition = etapasExistentes > 0 ? Math.max(...this.etapas.map(etapa => etapa.position)) + 1 : etapasExistentes + 1;
            const dados = {
                name: this.name,
                position : newPosition
            };
        
            const res = await fetch(`http://localhost:8000/api/funis/${this.id}/etapas`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer  ${Cookie.get('token')}`,
                 },
                body: JSON.stringify(dados)
            });

            if(res.ok) {
                this.name = '';
                alert('Nova etapa criada!')
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

        <div class="modal" :id="adicionar" tabindex="-1">
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
<style scoped>

.btn {
  background-color: #3057f2;
  color: white;
  width: 200px;
  height: 40px;
}
</style>