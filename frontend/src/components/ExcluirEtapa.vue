<script>
import { Modal } from 'bootstrap';
import Cookie from 'js-cookie';

export default {
    // name: "ExcluirEtapa",
    // props: {
    //     id: {
    //     type: Number,
    //     required: true
    //     },
    //     element: {
    //         type: Number,
    //         required: true
    //     },
    // },
    // data() {
    //     return {
    //         idExcluir: "modal" + this.element,
    //     }
    // },
    // methods: {
    //     showModal() {
            
    //         const modalElement = document.getElementById(this.idExcluir);
    //         const modal = new Modal(modalElement);
    //         modal.show();
    //     },

    //     async excluirEtapa() {

    //         try{
    //         const res = await fetch(`http://localhost:8000/api/funis/${this.id}/etapas/${this.element}`,  {
    //                     method: 'DELETE',
    //                     headers: {
    //                         'Accept': 'application/json',
    //                         'Content-Type': 'application/json',
    //                         'Authorization': `Bearer  ${Cookie.get('token')}`,
    //                     },   
    //                 });
    //             if(res.ok){
    //                 alert('Etapa Excluída');
    //             }
    //         }catch(error) {
    //             console.log(error)
    //         }
    //     }
    // }
}
</script>
<template>
     <div>
     <!-- <button type="submit" class="btn btn-primary" @click="showModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
    </svg></button>
    
    <div class="modal" :id="idExcluir" tabindex="-1"  data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Funil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body">
                    <form @submit.prevent="excluirEtapa">
                    <div>
                        <p> Deseja mesmo excluir ?</p>
                   </div>                  
                
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                
                    </form>
                
                </div>
                </div>
             </div>
        </div> -->
    </div>
</template>
<style scoped>


.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 0;
  display: none; 
}



</style>