<template>

  <div class="d-flex">
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-vertical d-flex flex-column align-items-start" id="navbar">
      <div class="container-fluid d-flex flex-column ">
        <div class="icone3c">
        <a class="navbar-brand" href="#" >
          <img width="70px" height="70px" src="../assets/logo3c.svg">
        </a>
        </div>
       
        
        <div class="collapse navbar-collapse flex-column" id="navbarNavDropdown">
          <ul class="navbar-nav flex-column">
          
            <li class="nav-item">
              <a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
              <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
              </svg></a>
            </li>
            
            <li class="nav-item dropdown flex-column">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Idioma
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">BR</a></li>
                <li><a class="dropdown-item" href="#">EN</a></li>
                <li><a class="dropdown-item" href="#">RU</a></li>
                <li><a class="dropdown-item" href="#">ES</a></li>
              </ul>
            </li>
          </ul>
        </div>
            <div class="collapse navbar-collapse flex-column" >
              <ul class="navbar-nav flex-column">
            <li class="nav-item" id="icone-sair">
              <a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
              <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
            </svg></a>
            </li>
          </ul>
        </div>
        
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'NavBar'
};
</script>

<style scoped>

.nav-item {
  display: flex;
  justify-content: space-between;
}
.icone3c {
  background-color: #FFBD00;
  width: 100px;
  display: flex;
  justify-content: center;
  position: fixed;
  
 
}

.container-fluid {
  display: flex;
  flex-direction: column;
  align-items: start;
  height: 100%;
 
}

.navbar-nav {
  display: flex;
  flex-direction: column;
  width: 100%;
}



.d-flex{
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}



#icone-sair {
  display: flex;
  justify-content: end;
  margin-bottom: 20px;
}


#navbarNavDropdown {
  margin-top: 100px;
}

.flex-column {
    flex-direction: column !important;
    justify-content: end;
}
</style>
