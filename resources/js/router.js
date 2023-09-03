import { createRouter, createWebHistory } from 'vue-router';

import LoginView from './components/auth/forms/login';
import RegisterView from './components/auth/forms/register';
import ProductLiewView from './components/product/productList';
import ProductFormView from './components/product/productForm';
import CategoryFormView from './components/category/categoryForm';
import VideoFormView from './components/video/videoForm';
import store from './store';

const routes = [
    {
        path: '/',
        redirect: () => {
            location.replace('/login');
        },
    },
    {
        path: '/login',
        name: 'Login',
        component: LoginView,
        meta: {
            breadcrumb: [],
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: RegisterView,
        meta: {
            breadcrumb: [],
        }
    },
    {
        path: '/home',
        name: 'Products',
        component: ProductLiewView,
        meta: {
            breadcrumb: ['Home', 'Products'],
        }
    },
    {
        path: '/product/add',
        name: 'Create New Product',
        component: ProductFormView,
        meta: {
            breadcrumb: ['Home', 'Products', 'Create Product'],
        }
    },
    {
        path: '/product/update/:id',
        name: 'Update Product',
        component: ProductFormView,
        meta: {
            breadcrumb: ['Home', 'Products', 'Update Product'],
        }
    },
    {
        path: '/category',
        name: 'Categories',
        component: CategoryFormView,
        meta: {
            breadcrumb: ['Home', 'Categories'],
        }
    },
    {
        path: '/video-player',
        name: 'Videos',
        component: VideoFormView,
        meta: {
            breadcrumb: ['Home', 'Videos'],
        }
    },
];



const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
