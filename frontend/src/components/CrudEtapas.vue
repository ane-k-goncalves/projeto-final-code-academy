<script>
import ExcluirEtapa from './ExcluirEtapa.vue';
import EditarEtapa from './EditarEtapa.vue';
import { Offcanvas } from 'bootstrap';
import Cookie from 'js-cookie';
import { Modal } from 'bootstrap';

export default {
    name: 'CrudEtapas',
    components: {
        ExcluirEtapa,
        EditarEtapa
    },
    data() {
        return {
            newName: '',
            idExcluir: "modal" + this.element,
        }
    },
    props: {
        id: {
            type: Number,
            required: true
        },
        element: {
            type: Number,
            required: true
        },
        name: {
            type: String,
            required: true
        }
    },
    methods: {
        show() {
            const myOffcanvas = document.getElementById('offcanvasRight');
            const bsOffcanvas = new Offcanvas(myOffcanvas);
            bsOffcanvas.show();
        },
        showModal() {
            const modalElement = document.getElementById(this.idExcluir);
            const modal = new Modal(modalElement);
            modal.show();
        },
   
        async editarEtapa() {
                const dados = {
                    name: this.newName,
                };
            
                try{
                const res = await fetch(`http://localhost:8000/api/funis/${this.id}/etapas/${this.element}`,  {
                            method: 'PUT',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer  ${Cookie.get('token')}`,
                            },
                            body: JSON.stringify(dados),
                        });
                    if(res.ok){
                        alert('Etapa editada')
                    }
                }catch(error) {
                    console.log(error)
                }
        },
        async excluirEtapa() {

            try{
            const res = await fetch(`http://localhost:8000/api/funis/${this.id}/etapas/${this.element}`,  {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer  ${Cookie.get('token')}`,
                        },   
                    });
                if(res.ok){
                    alert('Etapa Excluída');
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
    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Editar</button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel"> {{ element.name }} </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            
        <button type="submit" class="btn btn-primary" @click="showModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
        </svg></button>
    
        <div class="modal" :id="idExcluir" tabindex="-1"  data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir Funil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="excluirEtapa">
                      
                            <p> Deseja mesmo excluir ?</p>
                                        
                            <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn">Excluir</button>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" >
            <div class="card-header">
                Editar etapa
            </div>
            <div class="card-body">
                <form @submit.prevent="editarEtapa()" >
                    <div>
                    <label>Novo nome:</label>
                    <input v-model="newName" type="text" />
                    </div>
                    <button type="submit" class="btn">Salvar</button>                
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
  width: 100px;
  height: 40px;
 
}

.modal-body {
    margin: 40px;
}
.modal-body button {
   margin: 10px;
}

.card {
    margin: 30px;
    width: 300px;
    display: flex;
    justify-content: center;
   
}

.card-body button {
    margin: 10px;
}



</style>