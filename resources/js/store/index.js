import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        selectedCursor: 1,
        selectedCommand: 0
    },
    mutations: {
        increment(state) {
            if(state.selectedCursor < 4){
                state.selectedCursor++
            }
        },
        decrement(state) {
            if(state.selectedCursor > 1){
                state.selectedCursor--
            }
        },
        setSelectedCommand(state, command){
            state.selectedCommand = command
        }
    }
})

export default store;