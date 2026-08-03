import { createStore } from "vuex";
import axios from "./axios";
import router from "./router";

const store = createStore({
    state: {
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
    },
    actions: {
        getUser({ commit }) {
            return axios.get("/user").then((res) => {
                commit('setUser', res.data.data);

                if (res.data.data == null) {
                    router.push('/h-admin/auth')
                }

                return res;
            }).catch((error) => {



                if (error.status == 401 || error.data == null) {
                    router.push('/h-admin/auth')
                }
            });
        }
    }

});


export default store;