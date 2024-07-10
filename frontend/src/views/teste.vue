<template>
    <NavBar />
    <Teste />
  </template>
  
  <script>
  import NavBar from "../components/NavBar.vue"; // Certifique-se de que o caminho está correto
  import Teste from "../components/Teste.vue"; // Certifique-se de que o caminho está correto
  
  export default {
    name: 'App', // Ou o nome que preferir para sua view principal
    components: {
      NavBar,
      Teste
    }
  }
  </script>
  
  <style>
  /* Adicione estilos globais ou específicos para a view principal aqui, se necessário */
  </style>
  