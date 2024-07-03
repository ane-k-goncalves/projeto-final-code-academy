<script setup>


</script>
<template>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Login</h5>
                            <div class="col-md-12">
                                <form>
                                    <div class="mb-4 row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="inputEmail">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
                                        <div class="col-sm-8">
                                        <input type="password" class="form-control" id="inputPassword">
                                        </div>
                                    </div>
                                    <p> Forgot password</p>
                                <button type="button" class="btn">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>
<style scoped>

.container {
    position: relative;
    left: -300px;

}

.card {
    background: transparent;
    box-shadow: 0 0 10px #b6b1b1;
}

.btn {
    background-color: #FFB534;
}
.container{
    width: 500px;
}


</style>