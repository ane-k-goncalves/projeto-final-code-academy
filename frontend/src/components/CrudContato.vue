<script>
import Cookie from 'js-cookie';
import { Modal } from 'bootstrap';
import { Offcanvas } from 'bootstrap';

export default {
    name:"CrudContato",
    props: {
        element: {
            type: Number,
            required: true
        }
       
    },
    data() {
        return {
        name: '',
        telefone: '',
        email: '',
        data_de_nascimento: '',
        valor: '',
        ddd:'',
        endereco: '',
        idCrud: 'canvas' + this.element.id,
        idexcluir: "mod" + this.element.id
      }
    },
    methods: {
     
        show() {
            const myOffcanvas = document.getElementById(this.idCrud);
            const bsOffcanvas = new Offcanvas(myOffcanvas);
            bsOffcanvas.show();
        },
        showModal() {
            const modalElement = document.getElementById(this.idexcluir);
            const modal = new Modal(modalElement);
            modal.show();
        },
        async editarContato() {

          const dados = {
            name: this.name,
            telefone: this.telefone,
            email:this.email,
            data_de_nascimento: this.data_de_nascimento,
            valor: this.valor,
            ddd: this.ddd,
            endereco: this.endereco,

          }
            try {
                const res = await fetch(`http://localhost:8000/api/etapas/${this.element.etapa_id}/contatos/${this.element.id}`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer  ${Cookie.get('token')}`,
                 },
                body: JSON.stringify(dados)
                });
                if(res.ok) {
                    alert('Contato editado!');
                    location.reload();
                }
            }catch(error) {
                console.log(error)
            }
        },

        async excluirContato() {
            try{
            const res = await fetch(`http://localhost:8000/api/etapas/${this.element.etapa_id}/contatos/${this.element.id}`,  {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer  ${Cookie.get('token')}`,
                        },   
                    });
              if(res.ok){
                alert('Contato excluído.');
                location.reload();
              }
            }catch(error) {
                console.log(error)
            }
        }
    },
    mounted() {
        this.name = this.element.name;
        this.telefone = this.element.telefone;
        this.email = this.element.email;
        this.data_de_nascimento = this.element.data_de_nascimento;
        this.valor = this.element.valor;
        this.ddd = this.element.ddd;
        this.endereco = this.element.endereco;
    },
}
</script>
<template>
<div>
    <button class="btn" type="button" data-bs-toggle="offcanvas" :data-bs-target="'#' + idCrud" aria-controls="idCrud">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-front" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm5 10v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-2v5a2 2 0 0 1-2 2z"/>
</svg></button>

    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" :id="idCrud" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
      <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
      </svg></button>
  </div>
    <div class="offcanvas-body">

      <div class="card">
      <div class="card-header">
        <h5 class="card-title">Etapas</h5>
      </div>
      <div class="card-body">
        
        <div class="buttons">
          <button type="button" id="bot" class="btn btn-sm">Sem etapa</button>
          <button type="button" id="bot" class="btn btn-sm">Prospecção</button>
          <button type="button" id="bot" class="btn btn-sm">Contato</button>
          <button type="button" id="bot" class="btn btn-sm">Proposta</button>
        </div>
      </div>
    </div>
        <div>
    <div class="card">
      <div class="card-header">
        <h5>Contato</h5>
      </div>
       
      
      <div class="card-body">
      
        <form @submit.prevent="editarContato">
          
          <div class="mb-3 row">
            <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="telefone">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="email">
            </div>
          </div>
          <h5>Dados</h5>
          <div class="mb-3 row">
            <label for="nome" class="col-sm-2 col-form-label">Nome </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="name"  >
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
              <input type="number" class="form-control" v-model="valor">
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
        
          <button type="submit" id="btncolor"  class="btn">Editar Contato</button>
        </form>
      </div>
    </div>
        </div>
    </div>
    


    <button type="submit" class="btn" id="btnexcluir" @click="showModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
        </svg> Excluir contato</button>
    


    <div class="modal" :id="idexcluir" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Excluir contato</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>Tem certeza que deseja excuir o contato?</h5>
            <p>A ação não poderá ser desfeita.</p>
        </div>
        <div class="modal-footer">
          <form @submit.prevent="excluirContato">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" id="btndanger" class="btn">Confirmar</button>
          </form>
        </div>
        </div>
    </div>
    </div>
</div>

</div>
</template>
<style scoped>

.offcanvas {

  width: 600px;
}

.buttons{
  display: flex;
  justify-content: center;
}

#bot {
  margin: 10px;
  border-radius: 10px;
  width: 100px;
  background-color: #E1E9F4;
  
}

#btnexcluir {
  border-radius: 10px;
  width: 300px;
  background-color: #E1E9F4;
  margin-bottom: 20px;
  margin-left: 150px ;


}

h5 {
  text-align: start;

}

.card-header {
  border-color:  #E1E9F4;
  display: flex;
  justify-content: center;
  background-color: #638cc6;
}

label {
  display: flex;
  align-items: flex-start;
}

.card {
  margin-bottom: 15px ;
  border-color: #638cc6;
}

.modal-content {
  height: 300px;
}
h5 {
  color: #373753
}

.modal-body {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
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

#btndanger{
  background-color: #f23f2c;
  color: white;
}

#btncolor {
  background-color: #ffc107;
  width: 200px;
}

input {
  border-color:#638cc6;
  display: flex;
}

</style>