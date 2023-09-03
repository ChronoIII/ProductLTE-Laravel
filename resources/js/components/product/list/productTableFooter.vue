<template>
    <div class="d-flex justify-content-between w-full">
        <select @change="triggerSearch('count', $event.target.value)" class="form-select">
            <option value="10" :selected="pageCount === 10">Show records of 10</option>
            <option value="20" :selected="pageCount === 20">Show records of 20</option>
            <option value="30" :selected="pageCount === 30">Show records of 30</option>
            <option value="50" :selected="pageCount === 50">Show records of 50</option>
            <option value="100" :selected="pageCount === 100">Show records of 100</option>
        </select>

        <nav aria-label="Page navigation example">
            <ul class="pagination mb-0">
                <li @click="pageCommand(currentPage - 1)" :class="['page-item', {'disabled': (currentPage <= 1)}]">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <template v-for="index in products.last_page">
                    <li @click="triggerSearch('page', index)" :class="['page-item', {'active': currentPage === index}]">
                        <a href="#" class="page-link">
                            <span aria-hidden="true">{{ index }}</span>
                        </a>
                    </li>
                </template>
                <li @click="pageCommand(currentPage + 1)" :class="['page-item', {'disabled': (currentPage >= products.last_page)}]">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { mapMutations, mapActions, mapGetters } from 'vuex';

export default {
    props: {
        products: {
            type: Object,
            required: true,
        }
    },

    computed: {
        ...mapGetters([
            'currentPage',
            'pageCount',
        ])
    },

    methods: {
        ...mapMutations([
            'SET_PRODUCT_FILTER',
        ]),

        ...mapActions([
            'getProducts',
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
    }
}
</script>
