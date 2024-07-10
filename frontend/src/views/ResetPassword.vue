<script>
import { Modal } from 'bootstrap';
import Cookie from 'js-cookie';

export default {
    name: "ResetPassword",
    data() {
        return {
            token: '',
            email: '',
            password: '',
            password_confirmation: '',
            message: ''
        };
    },
    created() {
    // Extrair token da query string
    const urlParams = new URLSearchParams(window.location.search);
    const queryToken = urlParams.get('token');

    // Extrair token da rota
    const routeToken = this.$route.params.token;

    this.token = routeToken || queryToken;

    if (!this.token) {
      this.message = 'Token não encontrado na URL.';
    }

    
    },
    methods: {
        showModal() {
            const modalElement = document.getElementById('resetPassword');
            const modal = new Modal(modalElement);
            modal.show();
        },
        async resetPassword() {
            const req = {
                token: this.token,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            };
            try {
                const res = await fetch(`http://localhost:8000/api/reset-password`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(req),
                });

                if (res.ok) {
                    this.message = 'Senha redefinida com sucesso!';
                } else {
                    const errorData = await res.json();
                    this.message = errorData.message || 'Erro ao redefinir senha.';
                }
            } catch (error) {
                this.message = 'Erro ao redefinir senha.';
            }
        }
    }
};
</script>

<template>
    <div>
      

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Redefinir a senha</h5>
            </div>
            <div class="card-body">
                
                         <form @submit.prevent="resetPassword">
                            <label for="inputEmail">Email</label>
                            <input v-model="email" type="email" class="form-control" id="inputEmail">
                            
                            <label for="inputPassword">Nova senha</label>
                            <input v-model="password" type="password" class="form-control" id="inputPassword">
                            
                            <label for="inputNewPassword">Confirme a senha</label>
                            <input v-model="password_confirmation" type="password" class="form-control" id="inputNewPassword">
                            
                            <div class="botoes">
                             
                                <button type="submit" class="btn btn-primary">Continuar</button>
                            </div>
                        </form>
                
            </div>
            <p v-if="message">{{ message }}</p>
            </div>
    </div>
</template>

<style scoped>
.botoes {
    display: flex;
    align-items: end;
    justify-content: space-around;
    margin: 20px;
}
.btn {
    background-color: #FFB534;
    display: inline-flex;
    justify-content: space-between;
}
.modal-content {
    height: 350px;
}
label {
    display: flex;
    justify-content: flex-start;
}
.card {
    width: 500px;
    background: linear-gradient(to top, #b3d3f3 0%, #f7f7f7 100%);
    display: flex;
    justify-content: center;
    margin: 200px;
    border-color: #b3d3f3;
}

div {
     display: flex;
    justify-content: center;

}

.card-title {
    display: flex;
    justify-content: space-between;
    /* flex-direction: column;
    margin: 20px;
    text-align: center; */

}
p{
    display: flex;
    justify-content: center;
}
</style>
