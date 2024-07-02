<script setup>


</script>
<template>
    <div class="container">
    <form >
        <div class="mb-3 row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail">
        </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword">
        </div>
        </div>
    </form>
    </div>

</template>
<style scoped>

.container{
    width: 500px;
    background-color: linear-gradient(#050505);
    border-radius: 5px;
    border-color: #050505;
}

</style>