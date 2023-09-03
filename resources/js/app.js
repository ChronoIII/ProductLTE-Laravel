require('./bootstrap');
require('video.js');

import { createApp } from 'vue';
import App from './components/app';
import Store from './store';
import Router from './router';

const app = createApp(App);

app.use(Store);
app.use(Router);
app.mount('#app');
