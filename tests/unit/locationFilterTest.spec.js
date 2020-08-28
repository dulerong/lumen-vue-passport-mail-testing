import { shallowMount, createLocalVue } from '@vue/test-utils'
import Vuex from 'vuex'
import { BootstrapVue } from 'bootstrap-vue'
import LocationFilter from '../../resources/components/LocationFilter'

const localVue = createLocalVue()
localVue.use(BootstrapVue)
localVue.use(Vuex)

describe('LocationFilter.vue', () => {
  let actions
  let store

  beforeEach(() => {
    actions = {
      changeLocation: jest.fn(),
    }
    store = new Vuex.Store({
      actions
    })
  })
 
  it('LocationFilter: has checkbox called 新北市板橋區', () => {
    const wrapper = shallowMount(LocationFilter, { localVue, store })

    const checkBox = wrapper.find("[value='新北市板橋區']") 
    expect(checkBox.exists()).toBe(true)
  })

  it('LocationFilter: upon state change, executes action changeLocation', async () => {
    const wrapper = shallowMount(LocationFilter, { localVue, store })

    await wrapper.setData({ selected: ['新北市板橋區'] }) // setData is async, needs await to resolve promise
    expect(actions.changeLocation).toHaveBeenCalled()
  })
})