<script>
import Cookie from 'js-cookie';
import CrudContato from './CrudContato.vue';
import draggable from "vuedraggable";
import { Modal } from 'bootstrap';
import { Offcanvas } from 'bootstrap';


export default {
    name: "CardContato",
    data() {
        return {
            contatos: [],
          
        }
    },
    components: {
        CrudContato,
        draggable
    },
    props: {
        element: {
            type: Array,
            required: true
        },
        etapas: {
            type: Array,
            required: true
        }

    },
    methods: {
        async listarContatos() {
        try {
                
          
          const res = await fetch(`http://localhost:8000/api/etapas/${this.element}/contatos`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer  ${Cookie.get('token')}`,
                 },
              
          });
          if(res.ok) {
            const data = await res.json();
            this.contatos = data;
    

          }
        }catch(error){
            console.log(error)
        }
        },
        log(event){

            const { moved, added } = event;
            if (moved) {
                this.onDragEnd(moved);
            }
            if (added) {
                this.onDragStart(added);
            }
       
        },

        
        
        async onDragEnd({ newIndex, oldIndex }) {
         
            const contatoId = this.contatos[oldIndex].id;
            const newPosition = newIndex + 1;

            const dados = {
                newPosition,
                contatoId
            };

            console.log(newPosition, contatoId)

        try {
            const response = await fetch(
            `http://localhost:8000/api/etapas/${this.element}/contatos/${contatoId}/swap`,{
                method: "PUT",
                headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                Authorization: `Bearer  ${Cookie.get("token")}`,
                },
                body: JSON.stringify(dados)
            
            });
            const result = await response.json();
            if (result.ok) {
            await this.listarContatos();
            }
        } catch (error) {
            console.log(error);
            alert("Ocorreu um erro ao trocar as posições das etapas.");
        }

      
    }, 
   
        
     
    async onDragStart({newIndex, oldIndex}) {
        
        const contatoId = this.contatos[newIndex].id;

        const newPosition = newIndex + 1;

        const newEtapaId = this.etapas[newIndex].id;

        const dados = {
                newPosition,
                contatoId,
                newEtapaId
        }

         console.log(newPosition, contatoId,newEtapaId )
    
    try {
      const response = await fetch(
        `http://localhost:8000/api/etapas/${this.element}/contatos/${contatoId}/swap-phase`,{
          method: "PUT",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: `Bearer  ${Cookie.get("token")}`,
          },
          body: JSON.stringify(dados)
         
        }
      );
      const result = await response.json();
      if (result.ok) {
        await this.listarContatos();
      }
    } catch (error) {
      console.log(error);
      alert("Ocorreu um erro ao trocar as posições dos contatos.");
    }
  },

  
    },
    mounted() {
        this.listarContatos();

    },
    watch: {
        element() {
            this.listarContatos();
        }
    }
    
}
</script>
<template>
    <div>
        <!-- usar if para manipular as mudanças de  -->

       <draggable v-model="contatos" item-key="id"  @change="event => log(event)" group="contato">
        <template #item="{ element }">
          <div :key="element.id"  class="card" style="width: 240px;">
            <div class="card-body">
              
                 <CrudContato :element="element" />
                <h5 class="card-title">{{element.name}}</h5>
               
                <p class="card-text"> R${{ element.valor }}</p>
                
            </div>
            </div>
        </template>
        </draggable>
    </div>
</template>
<style scoped>
.card-title {
    display:flex;
    justify-content: flex-start;
    color: #373753;
}
.card-text {
    display:flex;
    justify-content: flex-start;
    margin-top: 20px;
    color: #677C92;
}
.card{
    margin: 10px
}


</style>