<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ category === null ? 'Add Category' : 'Update Category: ' + category.name }}</h3>
        </div>

        <div class="card-body">
            <div class="col-md-11 d-flex flex-wrap mx-auto">
                <label for="category" class="col-md-3 col-form-label text-left">Category name</label>
                <div class="col-md-8 d-flex">
                    <input v-model="sCategoryName" type="text" name="category" id="category" class="form-control">

                    <button @click.prevent="submitForm()" class="btn btn-primary ml-3 px-3">{{ category === null ? 'Add' : 'Update' }}</button>
                    <button @click.prevent="cancelUpdate()" v-if="category !== null" class="btn btn-outline-danger ml-1">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    props: {
        category: {
            type: Object,
            default: null,
        }
    },

    watch: {
        category(newVal) {
            if (newVal !== null && newVal?.name !== '') {
                this.sCategoryName = newVal.name
            }
        },
    },

    data() {
        return {
            sCategoryName: '',
        }
    },

    methods: {
        ...mapActions([
            'getCategories',
            'saveCategory',
        ]),

        submitForm() {
            let oCategory = {name: this.sCategoryName};
            if (this.category !== null) {
                oCategory['category_id'] = this.category.category_id;
            }

            this.saveCategory(oCategory)
                .then(() => {
                    this.getCategories();

                    this.sCategoryName = '';

                    this.$emit('submit-callback');
                });
        },

        cancelUpdate() {
            this.$emit('cancel-update');
            this.sCategoryName = '';
        }
    }
}
</script>
