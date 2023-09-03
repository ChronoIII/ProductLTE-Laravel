<template>
    <div class="col-12">
        <category-input-form :category="oCategory" @submit-callback="removeUpdateCategory()" @cancel-update="removeUpdateCategory()" />

        <category-list-form @update-category="(data) => oCategory = data" />
    </div>
</template>

<script>
import categoryInputForm from './forms/inputForm';
import categoryListForm from './forms/listForm';

export default {
    components: {
        categoryInputForm,
        categoryListForm,
    },

    data() {
        return {
            oCategory: null,
            sCategoryName: '',
        }
    },

    methods: {
        removeUpdateCategory() {
            this.oCategory = null;
        }
    }
}
</script>
