<script>
import Cookie from 'js-cookie';
import CrudContato from './CrudContato.vue';


export default {
    name: "CardContato",
    data() {
        return {
            contatos: []
        }
    },
    components: {
        CrudContato
    },
    props: {
        element: {
            type: Array,
            required: true
        },
       

       
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
        <div v-for="contato in contatos" :key="contato.id" class="card" style="width: 240px;">
            <div class="card-body">
                <CrudContato :id="contato.id" :element="element" />
                <h5 class="card-title">{{contato.name}}</h5>
               
                <p class="card-text"> R${{ contato.valor }}</p>
                
            </div>
        </div>
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


</style>