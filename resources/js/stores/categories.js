import CategoryService from '../services/CategoryService';

export default {
    state: {
        categories: []
    },

    mutations: {
        SET_CATEGORY_LIST(state, aList) {
            state.categories = aList;
        }
    },

    actions: {
        async getCategories({ commit }) {
            return await CategoryService.getCategories()
                .then(res => {
                    let aData = res.data.categories;
                    commit('SET_CATEGORY_LIST', aData);
                    return aData;
                });
        },

        async saveCategory({ }, oCategory) {
            return await CategoryService.saveCategory(oCategory)
                .then(res => {
                    return res.data.category;
                });
        },
    },

    getters: {
        categories(state) {
            return state.categories;
        },
    }
}
