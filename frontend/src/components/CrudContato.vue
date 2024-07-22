<script>
import Cookie from 'js-cookie';
import { Modal } from 'bootstrap';

export default {
    name:"CrudContato",
    props: {
        etapas: {
            type: Array,
            required: true
        },
       
    },
    data() {
        return {
        name: '',
        telefone: '',
        email: '',
        data_de_nascimento: '',
        valor: '',
        ddd:'',
        endereco: ''
      }
    },
    methods: {
        showModal() {
            const modalElement = document.getElementById(id);
            const modal = new Modal(modalElement);
            modal.show();
        },
        async editarContato() {
            try {
                const res = await fetch(`http://localhost:8000/api/etapas/${etapa.id}/contatos/${this.contato_id}`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer  ${Cookie.get('token')}`,
                 },
                body: JSON.stringify(dados)
                });
                if(res.ok) {
                        
                    alert('Contato editado!')
                }
            }catch(error) {
                console.log(error)
            }
        },

        async excluirContato() {
            try{
            const res = await fetch(`http://localhost:8000/api/etapas/${etapa.id}/etapas/${this.contato_id}`,  {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer  ${Cookie.get('token')}`,
                        },   
                    });
                if(res.ok){
                    alert('Contato excluído.');
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
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                            </svg>
    </button>

    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <div class="card">
      <div class="card-header">
        {{ nome  }} 
      </div>
      <div class="card-body">
        <h5 class="card-title">Funil nome</h5>
        <div class="buttons">
          <button type="button" id="bot" class="btn btn-sm">Sem etapa</button>
          <button type="button" id="bot" class="btn btn-sm">Prospecção</button>
          <button type="button" id="bot" class="btn btn-sm">Contato</button>
          <button type="button" id="bot" class="btn btn-sm">Proposta</button>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        Dados
      </div>
      <div class="card-body">
       
        <form @submit.prevent="editarContato">
          <div class="mb-3 row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="name">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" v-model="telefone">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="email">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="data_de_nascimento" class="col-sm-2 col-form-label">Data de Nascimento</label>
            <div class="col-sm-8">
              <input type="data" class="form-control" v-model="data_de_nascimento">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="valor" class="col-sm-2 col-form-label">Valor</label>
            <div class="col-sm-8">
              <input type="decimal" class="form-control" v-model="valor">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="ddd" class="col-sm-2 col-form-label">DDD</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" v-model="ddd">
            </div>
          </div>
          <div class="mb-4 row">
            <label for="endereco" class="col-sm-2 col-form-label">Endereço</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="endereco">
            </div>
          </div>
        
          <button type="submit" class="btn btn-primary">Editar Contato</button>
        </form>
      </div>
    </div>
        </div>
    </div>
    


    <button type="submit" class="btn btn-primary" @click="showModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
        </svg></button>
    


    <div class="modal" id="id" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>
</div>

</div>
</template>
<style scoped>

</style>