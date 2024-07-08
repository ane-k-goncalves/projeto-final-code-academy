<template>

<footer id="rodape">
            <div class="linkssociais">
                <a id="redesocial-1" href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-github"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                <a id="redesocial-2" href="#"><i class="fa-solid fa-envelope"></i></a>
            </div>

            <div id="atendimento">
                <p>Segunda à Sexta das 09h às 17h.</p>
                <p>(42) 9 8860-7575</p>
                <p>jorgedevsoftware@hotmail.com</p>
            </div>

          
          

            <div id="copyright">
                <p>	&copy; jorgeDevSoftware 2024</p>
            </div>


        </footer>
</template>

<script>


    export default{
        name:'Footer'
    }

</script>




<style>



footer {
    border-top: 3px solid #ffb703;
    height: 215px;
    background-color: #023047;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

footer div {
    display: flex;
    justify-content: center;
    align-items: center;
}

footer div a {
    font-size: 34px;
    text-align: center;
    margin: 15px 25px 25px 15px;
    color: #ffb703;
}

#redesocial-1 {
    margin-left: 500px;
}

#redesocial-2 {
    margin-right: 500px;
}

#atendimento {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center the content horizontally */
}

#atendimento p {
    color: #ffb703;
    font-size: 20px;
}

#formas-pagamento {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center the content horizontally */
    margin-top: 40px;
    color: #ffb703;
}

#formas-pagamento div {
    font-size: 28px;
}

#formas-pagamento div i {
    margin-left: 10px;
    margin-right: 10px;
}

#copyright {
    color: #ffb703;
    text-align: center; /* Center the text */
}
</style>