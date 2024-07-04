<script>
    export default {
        name: 'AnimationVue',
        data() {
            return {
                texts: ["Contratos", "Feedbacks", "Comunicação", "Produtividade","Gestão de informações"],
                currentIndex: 0,
                currentText: "Contratos"
            };
        },
        mounted() {
            this.startAnimation();
    
        },
        methods: {
            startAnimation() {
                setInterval(() => {
                    this.currentIndex = (this.currentIndex + 1) % this.texts.length;
                    this.currentText = this.texts[this.currentIndex];
                }, 4000 );
            }
        }
    };
</script>
<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="txt-animado">Organize e acompanhe todas as interações com clientes em um só lugar.<br>
                <span>{{ currentText }}</span>
            </h1>
            </div>
        </div>
    </div>
</template>
<style scoped>

.txt-animado {
    font-size: 45px;

}

.txt-animado span{
    position: relative;
    color: #3057F2;
}




.container {
    margin-left: auto;
    margin-right:200px ;
}

.row {
    margin: 20px;
    display: flex;
   
}
</style>