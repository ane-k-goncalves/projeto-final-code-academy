<script>
    export default {
        name: "VerifyEmail",
        props: ['id', 'hash'],
        data() {
            return {
            message: ''
            }
        },
        methods: {
            async verificar() {
                const urlParams = new URLSearchParams(window.location.search);
                const id = urlParams.get('id');
                const hash = urlParams.get('hash');

                if (!id || !hash) {
                    this.message = 'Invalid verification link.';
                    return;
                }

                try {
                    const verify = await fetch(`http://localhost:8000/api/verify-email/${this.id}/${this.hash}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                    });

                    if (verify.ok) {
                        this.message = 'Seu email foi verificado com sucesso!';
                        this.$router.push('/login');
                    } else {
                    
                    this.message = 'Erro ao verificar o email.';
                    }
        }catch(error){
            console.error('Erro:', error.message);
        }
        }
     },
     mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('verified')){
            this.verificationMessage = 'Email verificado com sucesso!';
        }
    }
}
    
</script>
<template>
    <div>
        <div class="card">
            <h5 class="card-header">Email Verificado</h5>
            <div class="card-body">
                <form @submit.prevent="verificar">
                <p class="card-text"> {{ message }}</p>
                <button type="submit" class="btn">Continue</button>
                </form>
            </div>
        </div>
    </div>
</template>
<style scoped>

</style>