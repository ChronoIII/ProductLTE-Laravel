<template>
    <div class="w-full d-md-flex justify-content-between align-items-center">
        <div class="col-md-6 d-flex p-0 mb-2 mb-md-0">
            <div class="input-group col-8 col-md-8 p-0 pr-1">
                <input v-model.trim="searchValue" @keydown.enter.prevent="triggerSearch('keyword', searchValue)" type="text" class="form-control mr-1" placeholder="Name or Description" aria-label="Search" aria-describedby="button-addon2">
                <button @click.prevent="triggerSearch('keyword', searchValue)" class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <select v-model="searchCategory" class="form-control col-4 col-md-6 col-lg-6 col-xl-4">
                <option selected value="">Category</option>
                <option v-for="(category, index) in categories" :key="index" :value="category.category_id">{{ category.name }}</option>
            </select>
        </div>

        <button @click="$router.push('/product/add')" class="btn btn-primary btn-sm col-md-3 w-100 h-100">
            <i class="fa-solid fa-plus"></i> Create New Product
        </button>
    </div>
</template>

<script>
import { mapMutations, mapActions } from 'vuex';

export default {
    props: {
        categories: {
            type: Array,
            required: true,
        }
    },

    data() {
        return {
            searchValue: '',
            searchCategory: '',
        }
    },

    watch: {
        searchCategory(newVal) {
            this.triggerSearch('category_id', newVal);
        }
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
    }
}
</script>
