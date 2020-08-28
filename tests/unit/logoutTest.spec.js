import { shallowMount, createLocalVue } from '@vue/test-utils'
import { BootstrapVue } from 'bootstrap-vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import Logout from '../../resources/components/auth/Logout'
import flushPromises from "flush-promises";

const localVue = createLocalVue()
localVue.use(BootstrapVue)
localVue.use(Vuex)

const routes = [

]  

const router = new VueRouter({ routes })

const $router = {
    push: jest.fn()
};

describe('Logout.vue', () => {
  let actions
  let getters
  let store

  beforeEach(() => {
    actions = {
      destroyToken: () => { return Promise.resolve() },
      clearDataAndRecord: jest.fn()
    }
    getters = {
        loggedIn: () => true
    }
    store = new Vuex.Store({
      actions,
      getters
    })
  })

  it('Logout page executes clearDataAndRecord', async () => {   
    const wrapper = shallowMount(Logout, { localVue, store })

    expect(actions.clearDataAndRecord).toHaveBeenCalled()
  })

  it('Logout page executes clearDataAndRecord', async () => {   
    const wrapper = shallowMount(Logout, { 
        localVue, 
        store, 
        mocks: { $router }
    })
    await actions.destroyToken()
    await flushPromises();
    expect($router.push).toHaveBeenCalled()
    


    
    // await wrapper.vm.$nextTick()
    // // expect($router.push).lastCalledWith({ name: "login" });
  })
})