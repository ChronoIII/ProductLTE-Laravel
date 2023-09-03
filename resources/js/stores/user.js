import UserService from '../services/UserService';

export default {
    state: {
        user: null,
    },

    mutations: {
        SET_USER_DATA(state, oUser) {
            state.user = oUser;
        },
    },

    actions: {
        async getUserData({ commit }) {
            return await UserService.getUserData()
                .then(res => {
                    let oUser = res.data.user;
                    commit('SET_USER_DATA', oUser);
                });
        },

        async logoutUser() {
            return await UserService.logoutUser()
                .then(res => {
                    console.log(res);
                });
        },
    },

    getters: {
        user(state) {
            return state.user;
        },
    }
}
