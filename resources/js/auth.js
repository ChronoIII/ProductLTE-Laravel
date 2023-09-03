require('./bootstrap');

import { createApp } from 'vue';
import Auth from './components/auth/auth';
import Store from './store';
import Router from './router';

const auth = createApp(Auth);

auth.use(Store);
auth.use(Router);
auth.mount('#auth');
