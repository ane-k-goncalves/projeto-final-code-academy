<template>

  <div class="d-flex">
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-vertical d-flex flex-column align-items-start" id="navbar">
      <div class="container-fluid d-flex flex-column ">
        <div class="icone3c"  @click="goToDashboard">
        <a class="navbar-brand" href="" >
            <img width="60px" height="60px" src="../assets/logo3c.svg">
        </a>
        </div>
       
        
        <div class="collapse navbar-collapse flex-column" id="navbarNavDropdown">
          <ul class="navbar-nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#" @click="goToDashboard" title="Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                </svg></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
              <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
              </svg></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
              <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
              <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
            </svg></a>
            </li>
   
          </ul>
        </div>
            <div class="collapse navbar-collapse flex-column" >
              <ul class="navbar-nav flex-column">
            <li class="nav-item" id="icone-sair">
              <form @submit.prevent="logout">
              <a class="nav-link" href="#"><button type="submit" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
              <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
            </svg>
            </button></a>
             </form>
            </li>
          </ul>
        </div>
        
      </div>
    </nav>
  </div>
</template>

<script>

import Cookie from 'js-cookie';

export default {

  name: 'NavBar',

  methods: {
   async logout() {
            const res = await fetch(`http://localhost:8000/api/logout`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer  ${Cookie.get('token')}`,
                        },
                    });
    
            if(res.ok) {
              alert('Até logo!');
              Cookie.remove('token'); 
              this.$router.push({ path: '/login' });
            }
      },
      goToDashboard() {
        this.$router.push("/dashboard");
      },
    }
  }

</script>

<style scoped>

.nav-item {
  display: flex;
  justify-content: space-between;
}
.icone3c {
  background-color: #FFBD00;
  width: 100px;
  height: 80px;
  display: flex;
  justify-content: center;
  margin-left: -12px;
  /* position: fixed; */
  
 
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

.navbar {
  box-shadow: 4px 4px 4px #585656;
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
  margin-top: -350px;
}

.flex-column {
    flex-direction: column !important;
    justify-content: end;
}
</style>
