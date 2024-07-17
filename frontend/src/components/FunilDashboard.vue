<script>

import { Modal } from 'bootstrap';
import CardFunil from './CardFunil.vue';
import Cookie from 'js-cookie';

export default {

  name: 'FunilDashboard',
    data() {
      return {
        name: '',
        newName: '',
        id: '',
        funils: {}
       
      }
    },
    
    components: {
      CardFunil,
     
    },
    methods: {
   
    showModal() {
        const modalElement = document.getElementById('adicionar');
        const modal = new Modal(modalElement);
        modal.show();
    },
    async criarFunil() {
      const dados = {
        name: this.name,        
      };

      try {
        const res = await fetch(`http://localhost:8000/api/register-funil`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${Cookie.get('token')}`,
                    },
                    body: JSON.stringify(dados),
                });

        
       
        if (res.ok) {
          alert('Funil cadastrado.');
          const data = await res.json();
          this.funils = data;
        } else {
         
          console.error('Erro no registro:', data);
        }
      }catch(error){
        console.log('Erro', error);
      }
    },
//     async fetchFunils() {
//       try{
//           const res = await fetch(`http://localhost:8000/api/register-funil/`, {
//              method: 'GET',
//              headers: {
//                 'Accept': 'application/json',
//                 'Content-Type': 'application/json',
//                 'Authorization': `Bearer ${localStorage.getItem('token')}`,
//             },
//             body: JSON.stringify(),
//           });
                
//           if(res.ok) {
//           const data = await res.json();
//           this.funils = data;
//         } else {
//           console.error('Erro ao buscar funis');
//         }
//       } catch (error) {
//         console.error('Erro na requisição', error);
//       }
//     }
//   },
//   mounted() {
//     this.fetchFunils();
//   }
// }

    }
}         
</script>
<template>
    <div>
        <button type="button" class="btn" @click="showModal"> Adicionar novo funil</button>

        <div class="modal" id="adicionar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Funil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                <div class="modal-body">
                    <form @submit.prevent="criarFunil">
                    <div>
                    <label>Nome:</label>
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
.container {
    margin: 80px;
}

button {
  background-color:blue;
  color: white;
  margin: 20px;
}
</style>
