<template>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <product-table-header :categories="categories" />
            </div>

            <div class="card-body">
                <product-table :products="products" />
            </div>

            <div v-if="products.data?.length >= 1" class="card-footer">
                <product-table-footer :products="products" />
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from 'vuex';
import productTable from './list/productTable';
import productTableHeader from './list/productTableHeader';
import productTableFooter from './list/productTableFooter';

export default {
    components: {
        productTable,
        productTableHeader,
        productTableFooter,
    },

    data() {
        return {
            searchValue: '',
            searchCategory: null,
        }
    },

    computed: {
        ...mapGetters([
            'products',
            'categories',
            'currentPage',
            'pageCount',
        ]),
    },

    methods: {
        ...mapMutations([
            'SET_PRODUCT_FILTER',
        ]),

        ...mapActions([
            'getProducts'
        ]),

        triggerSearch(sKey, mValue) {
            this.SET_PRODUCT_FILTER({
                key: sKey,
                value: mValue,
            });
            this.getProducts();
        },

        pageCommand(iNewPage) {
            if (iNewPage < 1 || iNewPage > this.products.last_page) {
                return;
            }
            this.triggerSearch('page', iNewPage);
        },
    },
}
</script>
