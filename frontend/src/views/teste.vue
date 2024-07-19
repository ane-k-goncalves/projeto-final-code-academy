<template>
    <NavBar />
    <!-- <Teste /> -->
    <TesteCards />
  </template>
  
  <script>
  import NavBar from "../components/NavBar.vue"; // Certifique-se de que o caminho está correto
  import Teste from "../components/Teste.vue";
  import TesteCards from "../components/TesteCards.vue"
  
  export default {
    name: 'teste', // Ou o nome que preferir para sua view principal
    components: {
      NavBar,
      Teste,
      TesteCards
    }
  }
  </script>
  
  <style>
  /* Adicione estilos globais ou específicos para a view principal aqui, se necessário */
  </style>
  