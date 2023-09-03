<template>
    <form>
        <text-box
            v-model:data="oProduct.name"
            label="Product Name"
            type="text" />

        <select-box
            v-model:data="oProduct.category_id"
            label="Category"
            :options="categories"
            option-value="category_id"
            option-show="name">
            <button @click.prevent="$router.push('/category')" class="btn btn-outline-secondary ml-2" data-tooltip="Add category">
                <i class="fa-solid fa-plus"></i>
            </button>
        </select-box>

        <rich-editor
            ref="quill-editor"
            v-model:dataTest="oProduct.description"
            @read-content="getDescriptionData"
            label="Description" />
    </form>
</template>

<script>
import { mapGetters } from 'vuex';

import textBox from '../../common/textBox';
import selectBox from '../../common/selectBox';
import richEditor from '../../common/richEditor';

export default {
    props: {
        product: {
            type: Object,
            default: null,
        }
    },

    components: {
        textBox,
        selectBox,
        richEditor,
    },

    watch: {
        product(newVal) {
            if (newVal !== null) {
                this.oProduct = _.cloneDeep(newVal);
            }
        }
    },

    data() {
        return {
            oProduct: {
                name: '',
                description: '',
                category_id: 0,
            },
        }
    },

    computed: {
        ...mapGetters([
            'categories',
        ]),

        isDescriptionEmpty() {
            let mDescription = this.oProduct.description;
            if (!mDescription) return true;
            if (mDescription.ops.length > 1) {
                return false;
            }
            let sDescription = mDescription.ops[0]?.insert?.replace('\n', '');
            return !sDescription;
        }
    },

    methods: {
        submitForm() {
            this.$refs['quill-editor'].readContent();

            let bValid = this.validateForm();
            if (bValid) {
                this.$emit('product-data', this.oProduct);
                return true;
            }
            return false;
        },

        validateForm() {
            let aKeys = Object.keys(this.oProduct);
            let aError = [];
            aKeys.forEach((sKey) => {
                let mData = this.oProduct[sKey];

                if (sKey === 'description') {
                    mData = this.isDescriptionEmpty;
                }
                if (mData === '' || mData === null || mData === true) {
                    aError.push(sKey);
                }
            });
            return aError.length <= 0;
        },

        getDescriptionData(a) {
            let cloneProduct = _.cloneDeep(this.oProduct);
            cloneProduct.description = a;
            this.oProduct = cloneProduct;
        }
    }
}
</script>
