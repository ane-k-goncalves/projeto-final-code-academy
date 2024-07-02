<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
   
    <div class="wrapper">
      <nav>
        <RouterLink to="/cadastro">Cadastro</RouterLink>
        <RouterLink to="/login">Login</RouterLink>
      </nav>
    </div>
  </header>

  <main>
    <RouterView />
  </main>
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
}

header {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 20px;
}

.wrapper {
  display: flex;
  justify-content: center;
  width: 100%;
}

nav {
  display: flex;
  gap: 20px;
}

main {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex: 1;
  width: 100%;
}

</style>
