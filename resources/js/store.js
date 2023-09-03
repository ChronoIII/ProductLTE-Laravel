import { createStore } from 'vuex';

import UserStore from './stores/user';
import ProductStore from './stores/products';
import CategoryStore from './stores/categories';

export default createStore({
    modules: [
        UserStore,
        ProductStore,
        CategoryStore,
    ]
});
