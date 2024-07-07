import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import ForgotPassword from './components/ForgotPassword.vue';

const app = createApp(App)

app.component('ForgotPassword', ForgotPassword);

app.use(router)
app.use(store)

app.mount('#app')
