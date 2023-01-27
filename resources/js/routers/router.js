import Carros from '../pages/Carros.vue';
import Usuarios from '../pages/Usuarios.vue';
import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/car-shop/carros/',
        name: 'carros',
        component: Carros
    },
    
    {
        path: '/car-shop/usuarios/',
        name: 'usuarios',
        component: Usuarios
    },
];

const router = new createRouter({
    history: createWebHistory(),
    routes
});

export default router;