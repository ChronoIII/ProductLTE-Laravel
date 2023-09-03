import ProductService from '../services/ProductService';

export default {
    state: {
        products: {
            data: []
        },
        filters: {
            keyword: '',
            category_id: '',
            count: 10,
            page: 1,
        }
    },

    mutations: {
        SET_PRODUCT_LIST(state, aList) {
            state.products = aList;
        },
        SET_PRODUCT_FILTER(state, aFilterUpdate) {
            let aCopyFilter = {...state.filters};
            aCopyFilter[aFilterUpdate['key']] = aFilterUpdate['value'];
            state.filters = aCopyFilter;
        },
    },

    actions: {
        async getProducts({ state, commit }) {
            return await ProductService.getProducts(state.filters)
                .then(res => {
                    let aData = res.data;
                    commit('SET_PRODUCT_LIST', aData.products);
                    return aData;
                });
        },

        async getProduct({ }, iProductId) {
            return await ProductService.getProduct(iProductId)
                .then(res => {
                    return res.data.product;
                });
        },

        async saveProduct({ dispatch }, oProduct) {
            return await ProductService.saveProduct(oProduct)
                .then(res => {
                    dispatch('getProducts');
                    return res.data;
                });
        },

        async deleteProduct({ dispatch }, iProductId) {
            return await ProductService.deleteProduct(iProductId)
                .then(res => {
                    dispatch('getProducts');
                })
        }
    },

    getters: {
        products(state) {
            return state.products;
        },
        currentPage(state) {
            return state.filters.page;
        },
        pageCount(state) {
            return state.filters.count;
        }
    }
}
