<script>
import { RouterLink, RouterView } from 'vue-router';
import AnimationVue from "./components/AnimationVue.vue";
import Cookie from 'js-cookie';
 
export default {
    name: "CRM" ,
      components: { 
          AnimationVue
     },
  
    mounted() {
      // Inicie a verificação recursiva quando o componente for montado
      this.tokenExpirado();
    },
    methods: {
      async tokenExpirado()  {
        try {
        const response = await fetch(`http://localhost:8000/api/logout`, {
             method: 'POST',
             headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer  ${Cookie.get('token')}`,
            },
        });
        if (!response.ok) {
          alert('Sua sessão expirou. Por favor, faça login novamente.');
          router.push('/login');
          
        }

      } finally {
       
        setTimeout(() => {
          this.tokenExpirado();
        }, 600000); 
      }
    
    }
  }
}

</script>

<template>
  <div id="app">
        <RouterView />  
  </div>
</template>

<style scoped>



#app {
  background: linear-gradient(to top, #f7f7f7 0%, #F5EDED 100%); ;
  height: 100vh;
  

}

/* .container{
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;

}

.btn {
    background-color: #FFB534;
    display:inline;
    justify-content: space-between;
    margin: 10px;
    margin-left: 50px;

}





main {
  margin-top: 100px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  flex: 1;
  width: 100%; 
} */









</style>
