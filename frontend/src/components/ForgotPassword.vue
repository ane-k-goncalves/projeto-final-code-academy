<script>
import { Modal } from 'bootstrap';
import Cookie from 'js-cookie';

import ResetPassword from '../views/ResetPassword.vue';

export default {
    
        name: 'ForgotPassword',
        components: { 
            ResetPassword
        },
        data() {
            return {
                email: '',
            }

        },
        methods: {
            showModal() {
                const modalElement = document.getElementById('forgotPasswordModal');
                const modal = new Modal(modalElement);
                modal.show();
            },
            async solicitar() {
            const req = {
                email: this.email,
               
            };
            
            try {
                const res = await fetch(`http://localhost:8000/api/forget-password`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    },
                    body: JSON.stringify(req),
                });

                if (res.ok) {
                    const data = await res.json();
                    if (data.token) {
                        Cookie.set('token', data.token);
                        console.log("Token de redefinição enviado com sucesso");
                        this.$router.push({ path: '/reset-password/:token', query: { token: data.token } });
                    }
                } else {
                    const errorData = await res.json();
                    console.error('Erro ao enviar o token de redefinição:', errorData);
                }
            } catch (error) {
                console.error('Erro na solicitação:', error);
            }
        } 
        
        }
    }
    
</script>
<template>
    <div>
     <button type="button" class="btn" @click="showModal"> Esqueceu a senha?</button>

            <div class="modal" id="forgotPasswordModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Solicite token para redefinir a senha</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="solicitar">
                        <label for="inputEmail">Email</label>
                        <input v-model="email" type="email" class="form-control" id="inputEmail">
                         <div class="botoes">       
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Solicite token</button>
                            
                        </div>  
                        </form>
                    </div>
                    </div>
                </div>
             </div>
     </div>
             
            
</template>
<style>
.botoes {
    display: flex;
    align-items: end;
    justify-content: space-around;
    margin: 20px;
}
.modal-content {
    height: 250px;
}

.btn {
    background-color: #FFB534;
    display:inline;
    justify-content: space-between;
  

}
</style>