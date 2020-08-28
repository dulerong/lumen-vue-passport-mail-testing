import { shallowMount, createLocalVue, RouterLinkStub  } from '@vue/test-utils'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import { BootstrapVue } from 'bootstrap-vue'
import NavBar from '../../resources/views/NavBar'
import About from '../../resources/views/About'
import Login from '../../resources/components/auth/Login'

const localVue = createLocalVue()
localVue.use(VueRouter)
localVue.use(BootstrapVue)
localVue.use(Vuex)

const routes = [
  { path: '/about', name: 'about', component: About},
  { path: '/login', name: 'login', component: Login},
]

const router = new VueRouter({ routes })

describe('NavBar.vue', () => {
    let getters
    let store

    beforeEach(() => {
        getters = {
            loggedIn: () => false,
            username: () => ''
        }
        store = new Vuex.Store({
            getters,
        })
    })
  it('has router-link', async () => {
    const wrapper = shallowMount(NavBar, {
        localVue,
        router,
        store,
        stubs: {
            RouterLink: RouterLinkStub 
        }
    })

    expect(wrapper.findAllComponents(RouterLinkStub).at(1).props().to).toBe('/about')
    expect(wrapper.find('.usernameBar').text()).toBe('User : Guest')

    router.push("/about")
    await wrapper.vm.$nextTick()

    expect(wrapper.vm.$route.name).toBe("about")

    // await wrapper.findAllComponents(RouterLinkStub).at(2).trigger('click')
    // await wrapper.vm.$nextTick()
    // expect(wrapper.vm.$route.name).toBe("about")

    // await aboutButton.trigger('click')
    // expect(wrapper.findAll('.nav-link').at(2).text()).toBe('About')
  })
})
