import { createApp } from 'vue';
import App from './frontend/presentation/App.vue';
import router from './frontend/router/index.js';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

// Íconos sólidos
import { faHouse, faTh, faHeart, faUser, faCartPlus, faSpinner } from '@fortawesome/free-solid-svg-icons';
// Íconos de marcas
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons';

// Agregar a la librería
library.add(faHouse, faTh, faHeart, faUser, faCartPlus, faSpinner, faWhatsapp);

import '../css/app.css';
import '../css/style.css';

const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);
app.mount('#app');
