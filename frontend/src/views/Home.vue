<template>
    <div>
    <nav id="navbar" class="navbar navbar-light bg-white shadow-sm fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <img id="img-nav" src="../assets/logo-3C.svg" alt="logo" class="ml-3">
          <button id="button-login" class="btn btn-warning rounded-pill mr-3" @click="goToLogin">Login</button>
          
        </div>
    </nav>
    
    <div class="container text-center mt-5 pt-5" id="home">
        <div class="row">
            <div class="col" id="info-home">
                <h1 id="h1-home" class="estilo-home">Mais vendas</h1>
                <h1 class="estilo-home">no seu negócio</h1>
                <div id="separador-home">
                    <p class="p-home">Uma ferramenta all-in-one para você vender,</p>
                    <p class="p-home">atender, cobrar e otimizar o seu tempo e o seu</p>
                    <p class="p-home">dinheiro.</p>
                </div>
            </div>
            <div class="col">
                <img src="../assets/Agrupar-1-1.png" alt="img-fundo" class="img-fluid">
            </div>
        </div>
    </div>

    <div id="empresas">
        <h4>Confiado por +1000 empresas</h4>
        <div id="logo-empresa">
            <img src="../assets/image.png" alt="">
            <img src="../assets/image copy.png" alt="">
            <img src="../assets/image copy 7.png" alt="">
            <img src="../assets/image copy 6.png" alt="">
            <img src="../assets/image copy 5.png" alt="">
            <img src="../assets/image copy 4.png" alt="">
            <img src="../assets/image copy 3.png" alt="">
            <img src="../assets/image copy 2.png" alt="">
        </div>

    </div>

    </div>
</template>

<script>
export default {
    name: 'home',
    methods: {
        goToLogin() {
            this.$router.push('/login');
        }
    }
}
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

#empresas{
    height: 100px;
    text-align: center;
    margin-top: 150px;
}

#empresas h4{
    font-size: 16px;
    margin-bottom: 10px;
    color: #76777c;
    margin-bottom: 30px;
}

#logo-empresa{
    display: flex;
    justify-content: space-between;
    height: 40px;
    margin-left: 20px;
    margin-right: 20px;
   
}

#img-nav {
    margin-left: 30px;
}

#navbar {
    height: 70px;
    width: 100%;
    background-color: #fff;
    box-shadow: 2px 2px 15px #76777c;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

#h1-home {
    margin-top: 100px;
    margin-right: 50px;
}

.estilo-home {
    color: #f4a10f;
    font-size: 60px;
}

.col {
    margin-top: 50px;
}

#separador-home {
    margin-top: 20px;
    padding-left: 130px; 
    font-size: 20px;
}

.p-home {
    text-align: left;
}

#button-login {
    border: none;
    padding: 5px 15px;
    margin: 0;
    height: calc(100% - 10px);
    display: flex;
    align-items: center;
}

#button-login:hover {
    background-color: #ffd750;
    transition: .5s;
}

#home {
    margin-top: 300px;
}
</style>
