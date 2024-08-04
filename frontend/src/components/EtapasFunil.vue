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
                alert('Nova etapa criada!')
                const newEtapa = await res.json();
                this.etapas.push(newEtapa);
                this.name = '';
                
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
        <button type="button" id="btncolor" class="btn" @click="showModal"> Adicionar nova etapa</button>

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
                    <label>Nome:</label>
                    <input v-model="name" type="text" />
                    </div>
                       
                    <div class="modal-footer">
                        <button type="button" id="btn-a" class="btn " data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btn-b" class="btn ">Salvar</button>
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