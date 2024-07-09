<script>
import AnimationVue from '@/components/AnimationVue.vue';
import Cookie from 'js-cookie';

export default {
   
  name: 'CadastroView',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      message: ''
    };
  },
  components: {
    AnimationVue,
  },
  methods: {
    async register() {
      try {
        const payload = {
          name: this.name,
          email: this.email,
          password: this.password
        };
        console.log(payload);

        const response = await fetch('http://localhost:8000/api/register-user', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        const data = await response.json();
        console.log(data);
        if (data.id) {
         
          this.$router.push('/dashboard');
        } else {
         
          console.error('Erro no registro:', data);
        }


        const sendVerificationResponse = await fetch('http://localhost:8000/api/resend', {
            method: 'POST',
            headers:{
               'Content-Type': 'application/json',
               'Authorization': 'Bearer' + (await response.json()).token
            }
        });

        if(sendVerificationResponse.ok) {
          this.message = 'Cadastro realizado. Por favor verifique seu email.';
        }else{
          const errorData = await sendVerificationResponse.json();
          this.message = 'Error: ' + errorData.message;
        }

       
      } catch (error) {
        console.error('Erro:', error.message);
      }
    }
  },
  
};

  
  
</script>
<template>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro</h5>
                            <div class="col-md-12">
                                <form @submit.prevent="register">
                                    <div class="mb-4 row">
                                        <label for="inputNome" class="col-sm-2 col-form-label">Nome</label>
                                        <div class="col-sm-8">
                                            <input v-model="name" type="name" class="form-control" id="inputNome">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input v-model="email" type="email" class="form-control" id="inputEmail">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
                                        <div class="col-sm-8">
                                        <input v-model="password" type="password" class="form-control" id="inputPassword">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <button type="submit" class="btn">Cadastre-se</button>
                                        <p> Já possui conta?  <RouterLink to="/login">Login</RouterLink></p>
                                    </div>
                                </form>
                                <div>{{ message }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
              <img width="100px" height="100px" src="../../src/assets/logo3c.svg">
            
              <div>
                <AnimationVue />
              </div>
            </div>
        </div>
        

</template>
<style scoped>

.container {
    position: relative;
    

}

.col {
   
    display: flex;
    justify-content: space-between;
  
}

.row {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

p {
    text-align: center;
    margin-top: 20px;
}

.card-title {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.card {
    background: transparent;
    box-shadow: 0 0 10px #b6b1b1;
    width: 450px;
    height: 500px;

}
.btn {
    background-color: #FFB534;
    width: 200px;
}


</style>