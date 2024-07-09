<script>
import { createFunil } from '../services/Funil';
import { Modal } from 'bootstrap';

export default {
  name: 'FunilDashboard',
  props: ['funil'],
  data() {
    return {
      formData: this.funil || {},
    };
  },
  methods: {
    async handleSubmit() {
      if (this.formData.id) {
        await updateFunil(this.formData.id, this.formData);
      } else {
        await createFunil(this.formData);
      }
      this.$emit('saved');
    },
  
  showModal() {
      const modalElement = document.getElementById('adicionar');
      const modal = new Modal(modalElement);
      modal.show();
  }
},
}
</script>
<template>
    <div>
        <button type="button" class="btn" @click="showModal"> Adicionar novo funil</button>

        <div class="modal" id="adicionar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Adicionar' }} Funil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                <div class="modal-body">
                    <form @submit.prevent="handleSubmit">
                    <div>
                    <label>Nome:</label>
                    <input v-model="formData.nome" type="text" />
                    </div>
                
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                
                    </form>
                
                </div>
                </div>
            </div>
        </div>
     </div>
      
  </template>
  

  