import { shallowMount, createLocalVue } from '@vue/test-utils'
import VueRouter from 'vue-router'
import App from '../../resources/App'

const localVue = createLocalVue()
localVue.use(VueRouter)

describe('App.vue', () => {
  it('main App component properly renders', async () => {   
    const wrapper = shallowMount(App, { localVue })
    expect(wrapper.exists()).toBe(true)
  })
})