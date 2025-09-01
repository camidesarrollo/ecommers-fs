import { createApp } from 'vue';
import App from './App.vue';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { 
  faHouse, 
  faTh, 
  faHeart, 
  faUser 
} from '@fortawesome/free-solid-svg-icons';

library.add(faHouse, faTh, faHeart, faUser);

import '../css/app.css';
import '../css/style.css';

const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');
