import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        screenId: 0,
        selectedMainCursor: 1,
        selectedSubCursor: 0,
        isInputMode: false,
    },
    mutations: {
        incrementMainCursor(state) {
            if (state.selectedMainCursor < 4) {
                state.selectedMainCursor++
            }
        },
        decrementMainCursor(state) {
            if (state.selectedMainCursor > 1) {
                state.selectedMainCursor--
            }
        },
        incrementSubCursor(state, limit) {
            if (state.selectedSubCursor < limit) {
                state.selectedSubCursor++
            }
        },
        decrementSubCursor(state) {
            if (state.selectedSubCursor > 0) {
                state.selectedSubCursor--
            }
        },
        setScreenId(state, command) {
            state.screenId = command
        },
    }
})

export default store;