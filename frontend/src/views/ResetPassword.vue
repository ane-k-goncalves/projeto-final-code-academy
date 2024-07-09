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
        const urlParams = new URLSearchParams(window.location.search);
        this.token = urlParams.get('token');
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
        <button type="button" class="btn" @click="showModal">Redefina a senha</button>

        <div class="modal" id="resetPassword" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Redefinir a senha</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="resetPassword">
                            <label for="inputEmail">Email</label>
                            <input v-model="email" type="email" class="form-control" id="inputEmail">
                            
                            <label for="inputPassword">Nova senha</label>
                            <input v-model="password" type="password" class="form-control" id="inputPassword">
                            
                            <label for="inputNewPassword">Confirme a senha</label>
                            <input v-model="password_confirmation" type="password" class="form-control" id="inputNewPassword">
                            
                            <div class="botoes">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Continuar</button>
                            </div>
                        </form>
                        <p v-if="message">{{ message }}</p>
                    </div>
                </div>
            </div>
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
.modal-title {
    color: black;
}
.modal-body {
    color: black;
}
</style>
