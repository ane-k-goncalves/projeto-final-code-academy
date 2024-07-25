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
        async onDragEnd(event) {
            this.newIndex = event.newIndex;
            this.oldIndex = event.oldIndex;

        
            const contatoMovido = this.contatos[this.oldIndex];
            const contatoId = contatoMovido.id;

        try {
            const response = await fetch(
            `http://localhost:8000/api/etapas/${this.element}/contatos/${contatoId}/swap`,
            {
                method: "PUT",
                headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                Authorization: `Bearer  ${Cookie.get("token")}`,
                },

            
            }
            );
            const result = await response.json();
            if (result.ok) {
            alert("Etapas trocadas");
            await this.listarContatos();
            }
        } catch (error) {
            console.log(error);
            alert("Ocorreu um erro ao trocar as posições das etapas.");
        }

      
    }, 
   
        
     
//     async ondragstart() {
    
//     try {
//       const response = await fetch(
//         `http://localhost:8000/api/etapas/${this.element}/contatos/${contatoId}/swap-phase`,
//         {
//           method: "PUT",
//           headers: {
//             Accept: "application/json",
//             "Content-Type": "application/json",
//             Authorization: `Bearer  ${Cookie.get("token")}`,
//           },

         
//         }
//       );
//       const result = await response.json();
//       if (result.ok) {
//         alert("Contato trocado de posição");
//         await this.listarContatos();
//       }
//     } catch (error) {
//       console.log(error);
//       alert("Ocorreu um erro ao trocar as posições dos contatos.");
//     }
//   },

  
   
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

       <draggable v-model="contatos" item-key="id"  @end="onDragEnd"  group="contato">
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