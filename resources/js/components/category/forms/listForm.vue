<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories</h3>
            </div>

            <div class="card-body">
                <table v-if="categories.length > 0" class="table table-striped">
                    <colgroup>
                        <col style="width: auto">
                        <col style="width: 10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <template v-for="(category, index) in categories" :key="index">
                            <tr>
                                <td>{{ category.name }}</td>
                                <td class="d-flex justify-content-center">
                                    <button @click.prevent="$emit('update-category', category)" type="button" class="btn btn-link btn-sm btn-rounded">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div v-else>
                    <p class="text-lg text-center my-2">No category to show</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {
            iCategoryId: null,
            sCategoryName: ''
        }
    },

    computed: {
        ...mapGetters([
            'categories'
        ]),
    },

    methods: {
        ...mapActions([
            'getCategories'
        ]),
    },

    mounted() {
        this.getCategories();
    }
}
</script>
