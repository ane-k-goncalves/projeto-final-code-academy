<script>
import { Offcanvas } from 'bootstrap';
import Cookie from 'js-cookie';

export default {
    name: 'CriarContato',
    props: {
        element: {
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
        cpf:'',
        endereco: '',
        idCriar: 'canvas' + this.element,
        selectedFile: null 
      }
    },
    methods: {
      show() {
            const myOffcanvas = document.getElementById(this.idCriar);
            const bsOffcanvas = new Offcanvas(myOffcanvas);
            bsOffcanvas.show();
      },
      async criarContato() {
        try {
          const dados = {
            name: this.name,
            telefone: this.telefone,
            email: this.email,
            data_de_nascimento: this.data_de_nascimento,
            valor: this.valor,
            ddd: this.ddd,
            cpf: this.cpf,
            endereco: this.endereco,
        
          }

          
          
          const res = await fetch(`http://localhost:8000/api/etapas/${this.element}/contatos`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer  ${Cookie.get('token')}`,
                 },
                body: JSON.stringify(dados)
          });
          if(res.ok) {
                
            alert('Novo contato criado!');
            await this.listarContatos();
          }
        }catch(error){
            console.log(error)
        }
    },
    handleFileChange(event) {
      this.selectedFile = event.target.files[0]
    },
    async importCSV() {
      try{

        if (!this.selectedFile) {
          alert('Por favor, selecione um arquivo CSV.');
          return;
        }
        
        console.log(this.selectedFile);
        
        const formData = new FormData();
        formData.append('file', this.selectedFile);

      const res = await fetch(`http://localhost:8000/api/etapas/${this.element}/contatos/import`, {
                method: 'POST',
                headers: {
                   'Authorization': `Bearer  ${Cookie.get('token')}`,
                 },
                 body: formData
          });
          if(res.ok) {
                
            alert('Novos contatos importados!');
            await this.listarContatos();
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
  

<button class="btn" id="c" type="button" data-bs-toggle="offcanvas" :data-bs-target="'#' + idCriar" aria-controls="idCriar">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                            </svg>
</button>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" :id="idCriar" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
    </svg>Voltar</button>
    

  </div>
  <div class="offcanvas-body">
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
       
        <form @submit.prevent="criarContato">
          <div class="mb-3 row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="name">
            </div>
          </div>
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
          <div class="mb-3 row">
            <label for="data_de_nascimento" class="col-sm-2 col-form-label">Data de Nascimento</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="data_de_nascimento">
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
          <div class="mb-3 row">
            <label for="cpf" class="col-sm-2 col-form-label">CPF</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="cpf">
            </div>
          </div>
          <div class="mb-4 row">
            <label for="endereco" class="col-sm-2 col-form-label">Endereço</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" v-model="endereco">
            </div>
          </div>
        
          <button type="submit" class="btn btn-primary">Criar Contato</button>
        </form>
      </div>
    </div>

    <input type="file" id="csvFileInput" accept=".csv" @change="handleFileChange">>
    <button class="btn btn-primary" @click="importCSV()">Importar CSV</button>
   
  </div>
</div>

</div>
</template>
<style scoped>
.offcanvas {
  width: 600px;
  border-color:  #E1E9F4;
}

#c {
  margin:10px;
  background-color: #E1E9F4;
    
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
#bot a:hover{
  background-color: #3057F2;
  ;
}

.card {
  border-color: #E1E9F4;
  margin-bottom: 20px;
 
}
.card-header {
  border-color:  #E1E9F4;
}

input {
  border-color: #E1E9F4;
}
</style>