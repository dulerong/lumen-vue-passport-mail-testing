import { mount, shallowMount, createLocalVue } from '@vue/test-utils'
import Vuex from 'vuex'
import { BootstrapVue } from 'bootstrap-vue'
import "regenerator-runtime/runtime"
import LoadAndSave from '../../resources/components/LoadAndSave'

const localVue = createLocalVue()
localVue.use(BootstrapVue)
localVue.use(Vuex)

describe('LoadAndSave.vue', () => {
  let actions
  let getters
  let store

  beforeEach(() => {
    actions = {
      fetchData: jest.fn(),
      saveData: jest.fn()
    }
    getters = {
      locationSelected: () => ['新北市板橋區'],
      ageSelected: () => ['20～24歲']
    }
    store = new Vuex.Store({
      actions,
      getters,
    })
  })
  it('LoadAndSave: fetchData function fires off when location and age are defined', async () => {
    const wrapper = mount(LoadAndSave, { 
      localVue, 
      store,
    })

    const button = wrapper.find('#loadButton')

    await button.trigger('click')
    
    expect(button.exists()).toBe(true)
    expect(actions.fetchData).toHaveBeenCalled()
  })
})