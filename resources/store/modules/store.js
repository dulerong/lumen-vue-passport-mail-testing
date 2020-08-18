import router from '../../router/router';
import axios from 'axios'

const state = { 
    loading: false,
    count: {results: 0, birthCount: 0, birthMale: 0, birthFemale: 0},
    locationSelected: [],
    ageSelected: [],
    birthOrder: '所有胎數',
    birthGender: '所有性別',
    comment: '',
    savedData: [],
    records: [],
    token: localStorage.getItem('access_token') || null,
    username: localStorage.getItem('username') || null
};
const getters = { 
    loading:            state => state.loading,
    count:              state => state.count,
    locationSelected:   state => state.locationSelected,
    ageSelected:        state => state.ageSelected,
    birthOrderSelected: state => state.birthOrder,
    birthGenderSelected:state => state.birthGender,
    comment:            state => state.comment,
    savedData:          state => state.savedData,
    records:            state => state.records,
    loggedIn(state){ return state.token !== null },
    username(){ return state.username }
};
const actions = {
    changeLoading({ commit }){ commit('changeLoading')},
    changeLocation({ commit }, data){ commit('changeLocation', data) },
    changeAge({ commit }, data){ commit('changeAge', data) },
    changeBirthOrder({ commit }, data){ commit('changeBirthOrder', data)},
    changeBirthGender({ commit }, data){ commit('changeBirthGender', data)},
    changeComment({ commit }, data){ commit('changeComment', data)},
    retrieveSavedData({ commit }){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + state.token

        axios.get('api/stats')
            .then(res => { commit('retrieveSavedData', res.data) })
            .catch(err => console.log(err))
    },
    deleteSavedData({ }, id){ 
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + state.token

        axios.delete(`api/stats/${id}`)
            .then(res => router.go())
            .catch(err => console.log(err))
    },
    fetchData({ commit, state }){ 
        commit('changeLoading') // turn on loading status
        const proxyUrl = 'https://cors-anywhere.herokuapp.com/' // need this to bypass CORS
        const page_url = 'https://od.moi.gov.tw/api/v1/rest/datastore/301000000A-001414-014'; // actual API url
        axios.get(proxyUrl + page_url)
            .then(res => { 
                commit('fetchData', res.data.result.records)

                // calculate total data received
                commit('updateCountResult', state.records.length )
                
                // calculate total birth
                commit('updateCountBirth', state.records.reduce((total, record) => {return total + record.birth_count}, 0)) 
                
                // calculate total male birth
                commit('updateCountMale', state.records.filter(record => record.birth_sex === "男").reduce((total, record) => {return total + record.birth_count}, 0)) 
                
                // calculate total female birth
                commit('updateCountFemale', state.count.birthCount - state.count.birthMale)
                
                // turn off loading status
                commit('changeLoading')
            })
    },
    saveData({ state }){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + state.token
        const data = {
            "selected": state.locationSelected.join(", "),
            "motherAge": state.ageSelected.join(", "),
            "birthOrder": state.birthOrder,
            "birthGender": state.birthGender,
            "birthCount": state.count.birthCount,
            "birthMale": state.count.birthMale,
            "birthFemale": state.count.birthFemale,
            "comment": state.comment
        }
        axios.post("api/stats", JSON.stringify(data), { headers: {'Content-Type': 'application/json'} })
            .catch(err => console.log(err))
    },
    retrieveToken({ commit }, data){ 
        commit('changeLoading')
        return new Promise((resolve, reject) => {
            axios.post('/login', data)
            .then(res => { 
                const token = res.data.access_token
                localStorage.setItem('access_token', token)
                commit('retrieveToken', token)
                commit('changeLoading')
                resolve(res)
            })
            .catch(err => {
                console.log(err)
                reject(err)
            })
        })
    },
    register({ }, data){
        return new Promise((resolve, reject) => {
            axios.post('/register', data)
            .then(res => {
                resolve(res)
            })
            .catch(err => {  
                console.log(err)
                reject(err)
            })
        })
    },
    destroyToken({ commit, state }){
        return new Promise((resolve, reject) => {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + state.token
            axios.get('/logout')
                .then(res => {
                    localStorage.removeItem('access_token')
                    commit('destroyToken')
                    resolve(res)
                })
                .catch(err => { 
                    localStorage.removeItem('access_token')
                    console.log(err)
                    reject(err)
                })
        }) 
    },
    clearDataAndRecord({ commit }){ 
        localStorage.removeItem('username')
        commit('clearDataAndRecord')
    },
    retrieveUserName({ commit }){ 
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + state.token
        axios.get('/api/username')
            .then(res => {
                const username = res.data
                localStorage.setItem('username', username)
                commit('retrieveUserName', username)
            })
            .catch(err => console.log(err)) 
    }
};
const mutations = { 
    changeLoading:     state => state.loading = !state.loading,
    changeLocation:   (state, data) => state.locationSelected = data,
    changeAge:        (state, data) => state.ageSelected = data,
    changeBirthOrder: (state, data) => state.birthOrder = data,
    changeBirthGender:(state, data) => state.birthGender = data,
    changeComment:    (state, data) => state.comment = data,
    updateCountResult:(state, data) => state.count.results = data,
    updateCountBirth: (state, data) => state.count.birthCount = data,
    updateCountMale:  (state, data) => state.count.birthMale = data,
    updateCountFemale:(state, data) => state.count.birthFemale = data,
    retrieveSavedData:(state, data) => {
        // save data to state and exclude unnecessary properties using ES6 destructuring
        state.savedData = data.map(({created_at, updated_at, user_id, ...rest}) => rest)
            
        // remove Chinese characters 新北市, and 區 from location
        state.savedData.forEach(record => record.location = record.location.replace(/\u65b0\u5317\u5e02/g, ""))
        state.savedData.forEach(record => record.location = record.location.replace(/\u5340/g, ""))

        // count how many regions included, if 12 regions (eleven commas), display as 全新北市, if not, do nothing
        state.savedData.forEach(record => { if(record.location.length > 2){ record.location.match(/,/g).length === 11 ? record.location = "全新北市" : "" }})
    },
    fetchData: (state, data) => {
        state.records = data
            .map(({statistic_yyy, according, ...rest}) => rest) // exclude unnecessary properties using ES6 destructuring
            .filter(record => record.birth_count > 0) // exclude zero birth count record
            .filter(record => state.locationSelected.indexOf(record.site_id) > -1) // location filter
            .filter(record => state.ageSelected.indexOf(record.mother_age) > -1) // mother age filter
            .filter(record => state.birthOrder  === '所有胎數'? true : record.birth_order === state.birthOrder) // birth order filter
            .filter(record => state.birthGender === '所有性別'? true : record.birth_sex   === state.birthGender) // gender filter
        
        // turn all birth_count to numbers
        state.records.forEach(record => record.birth_count = Number(record.birth_count))
    },
    retrieveToken: (state, token) => { state.token = token },
    destroyToken: (state)  => { state.token = null },
    clearDataAndRecord: (state) => { 
        state.savedData = []
        state.records = []
        state.count = {results: 0, birthCount: 0, birthMale: 0, birthFemale: 0}
        state.username = null
    },
    retrieveUserName: (state, username) => { state.username = username }
};

export default {
    state,
    getters,
    actions,
    mutations
}