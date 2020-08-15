import Vue from 'vue'
import router from './router/router';
import App from './App'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from './store/index'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)){
    if(!store.getters.loggedIn){next({ name: 'login'})}
    else{next()}
  }
  else if(to.matched.some(record => record.meta.requiresVisitor)){
    if(store.getters.loggedIn){next({ name: 'home' })}
    else{next()}
  }
  else{next()}
})

new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount("#app");