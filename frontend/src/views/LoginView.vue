<script>
import ForgotPassword from "../components/ForgotPassword.vue";
import AnimationVue from "../components/AnimationVue.vue";

import Cookie from 'js-cookie';

export default {
    name: 'LoginView',
    data() {
    return {
      email: '',
      password: '',
    
    };
  },
  components: {
    ForgotPassword,
    AnimationVue
  },
  
  methods: {
    subt() {
        const payload = {
            email: this.email,
            password: this.password,
        };
        

        fetch(`http://localhost:8000/api/login`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                
              
            },
            body: JSON.stringify(payload),
        }).then(response => response.json())
        .then(res => {
            if (res.token){
             Cookie.set('token', res.token);
             this.$router.push('/dashboard');
        } else {
          alert('Login failed');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        })
    },
  },
}
            

</script>
<template>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Login</h5>
                            <div class="col-md-12">
                                <form @submit.prevent="subt">
                                    <div class="mb-4 row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input
                                            v-model="email" type="email" class="form-control" id="inputEmail">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
                                        <div class="col-sm-8">
                                        <input 
                                        v-model="password" type="password" class="form-control" id="inputPassword">
                                        </div>
                                       
                                    </div>
                                    <div class="mb-4 row">
                                        <button type="submit" class="btn">Login</button>
                                        <p> Não possui cadastro? <RouterLink to="/">Cadastre-se</RouterLink></p>
                                    </div>
                                    <div class="esqueceuSenha">
                                    <ForgotPassword />
                                    </div>
                                </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <img width="100px" height="100px" src="../assets/logo3c.svg">
                
                <div>
                    <AnimationVue />
                </div>
            </div>
        </div>

</template>
<style scoped>

.container {
    position: relative;
    display: flex;
    justify-content: center;

}

.col {
   
    display: flex;
    justify-content: space-between;
  
}
.esqueceuSenha {
    display: flex;
    justify-content: center;
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