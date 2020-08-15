import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home';
import About from '../views/About';
import Data from '../views/Data';
import Login from '../components/auth/Login'
import Register from '../components/auth/Register'
import Logout from '../components/auth/Logout'
import ResetPassword from '../components/auth/ResetPassword'

// this page sets up router, and router will be utilized in main.js
// specifies what page to serve on which director
// eg: for root directory "/", component Home will be serve, which is ./views/Home.vue

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        { path: '/', name: 'home', component: Home }, 
        { path: '/about', name: 'about', component: About},
        { path: '/data', name: 'data', component: Data, meta: { requiresAuth: true }},
        { path: '/login', name: 'login', component: Login, meta: { requiresVisitor: true }},
        { path: '/register', name: 'register', component: Register, meta: { requiresVisitor: true }},
        { path: '/logout', name: 'logout', component: Logout},
        { path: '/resetpassword', name: 'resetpassword', component: ResetPassword, meta: { requiresVisitor: true } }
    ],
})

export default router