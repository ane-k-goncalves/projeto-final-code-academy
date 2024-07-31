<template>
    <div>
        <nav id="navbar" class="navbar navbar-light bg-white shadow-sm fixed-top">
            <div class="container d-flex justify-content-between align-items-center">
                <img id="img-nav" src="../assets/logo-3C.svg" alt="logo" class="ml-4">
                <div class="d-flex align-items-center ml-3" id="nav-li">
                    <div class="dropdown mx-2">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtonSolucoes" data-bs-toggle="dropdown" aria-expanded="false">
                            Soluções
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSolucoes">
                            <li><a class="dropdown-item" href="#">Atendimento e suporte</a></li>
                            <li><a class="dropdown-item" href="#">Cobranças</a></li>
                            <li><a class="dropdown-item" href="#">Vendas</a></li>
                        </ul>
                    </div>
                    <div class="dropdown mx-2">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtonFuncionalidades" data-bs-toggle="dropdown" aria-expanded="false">
                            Funcionalidades
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonFuncionalidades">
                            <li><a class="dropdown-item" href="#">Chatbot</a></li>
                            <li><a class="dropdown-item" href="#">Discador Automático</a></li>
                            <li><a class="dropdown-item" href="#">Omnichannel</a></li>
                            <li><a class="dropdown-item" href="#">SMS</a></li>
                        </ul>
                    </div>
                    <div class="dropdown mx-2">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtonA3C" data-bs-toggle="dropdown" aria-expanded="false">
                            A 3C+
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonA3C">
                            <li><a class="dropdown-item" href="#">Instituto 3C+</a></li>
                            <li><a class="dropdown-item" href="#">Quem somos</a></li>
                            <li><a class="dropdown-item" href="#">Materiais gratuitos</a></li>
                        </ul>
                    </div>
                    <a href="#" class="nav-link mx-2" id="blog-link">Blog</a>
                    <a href="#" class="nav-link mx-2" id="partner-link">Seja um parceiro</a>
                </div>
                <div class="d-flex align-items-center ml-auto" id="button-right">
                    <button id="button-login" class="btn btn-warning rounded-pill mx-2" @click="goToLogin">Login</button>
                    <button id="button-signup" class="btn btn-warning rounded-pill" @click="goToCadastro">Cadastro</button>
                </div>
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
        <div id="motivation">
        <div id="opq">
            <div class="alnopq">
            <h2>Por que</h2>
            <h2>usar o</h2>
            <h2>3C Plus?</h2>
            </div>
        </div>
        <div class="divs-motivation">
            <div class="aln">
            <h5>Vender mais</h5>
            <p>Transforme leads em</p>
            <p>vendas ao otimizar</p>
            <p>sua comunicação.</p>
            </div>
        </div>
        <div class="divs-motivation">
            <div class="aln">
            <h5>Gerir melhor</h5>
            <p>Organize todo o seu</p>
            <p>atendimento em uma</p>
            <p>única ferramenta.</p>
            </div>
        </div>
        <div class="divs-motivation">
            <div class="aln">
            <h5>Conecte texto e voz</h5>
            <p>para falar com mais</p>
            <p>clientes em menos</p>
            <p>tempo.</p>
            </div>
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
        },
        goToCadastro() {
            this.$router.push('/cadastro');
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

#empresas {
    height: 100px;
    text-align: center;
    margin-top: 150px;
}

#empresas h4 {
    font-size: 16px;
    margin-bottom: 10px;
    color: #76777c;
    margin-bottom: 30px;
}


#logo-empresa {
    display: flex;
    justify-content: space-between;
    height: 40px;
    margin-left: 60px;
    margin-right: 20px;
}

#img-nav {
    margin-left: 150px;
}

#info-home{
    margin-left: 200px;
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
    margin-left: 100px;
}

#separador-home {
    margin-top: 20px;
    padding-left: 130px;
    font-size: 20px;
}
.img-fluid{
    margin-top: 80px;
    margin-left: 300px;
}
.p-home {
    text-align: left;
}

#button-login, #button-signup {
    border: none;
    padding: 5px 15px;
    margin: 0;
    height: calc(100% - 10px);
    display: flex;
    align-items: center;
}

#nav-li button{
    margin-right: 30px;
}
#button-login:hover, #button-signup:hover {
    background-color: #ffd750;
    transition: .5s;
}

.dropdown-toggle {
    background-color: transparent;
    color: black;
    border: none;
    font-size: 1.1rem;
}

.dropdown-menu {
    text-align: left;
    border-radius: 10px;
    box-shadow: 0px 2px 5px rgba(0,0,0,0.15);
    padding: 10px;
}

.dropdown-item {
    text-align: left;
}

#home {
    margin-top: 300px;
}

#blog-link, #partner-link {
    color: black;
    text-decoration: none;
    padding: 0.5rem 1rem;
    display: block;
    font-size: 1.1rem;
}
#button-right{
    margin-left: 200px
}

#opq{
 
    margin-right: 80px;
    height: 250px;
    width: 230px;
    box-shadow: 2px 5px 10px #76777c;
    text-align: center;
    color: #76777c;
    font-size: 29;
    background-color: #F0FFFF;
    border-radius: 20px;
   
    

}

#motivation{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 600px;
}


.divs-motivation{
    margin-left: 20px;
    margin-right: 20px;
    height: 350px;
    width: 230px;
    background-color: #4682B4;
    text-align: center;
    border-radius:  20px;
    color: #fff;
    box-shadow: 2px 5px 10px #76777c;
    
}

.divs-motivation h5 {

   margin-bottom: 10px; 
}
.aln{
    margin-top: 110px;
    
}

.alnopq{

    margin-top: 55px;
}
</style>
