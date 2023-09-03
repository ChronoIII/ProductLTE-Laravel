<template>
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div v-if="aCardTitleList[iCurrentStep - 1] && !bLoading" class="card-header text-bold">{{ aCardTitleList[iCurrentStep - 1] }}</div>

            <div class="card-body">
                <form-step1 v-show="iCurrentStep === 1" :product="oProduct" ref="step1" @product-data="setProductData" />
                <form-step2 v-show="iCurrentStep === 2" :images="aImages" ref="step2" @image-data="setImageData" @image-to-delete="setImageToDelete" />
                <form-step3 v-show="iCurrentStep === 3" ref="step3" :date="oProduct.date_time" @datetime-data="setDatetime" />

                <template v-if="iCurrentStep === 4">
                    <div v-if="bLoading" class="d-flex justify-content-center py-5">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <form-result v-else />
                </template>
            </div>

            <div v-if="!bLoading" class="card-footer">
                <div class="float-right">
                    <template v-if="iCurrentStep <= 3">
                        <a v-if="iCurrentStep > 1" @click.prevent="previous()" href="#" class="btn btn-secondary mr-2">Go Back</a>
                        <a v-if="iCurrentStep !== 3" @click.prevent="next()" href="#" class="btn btn-primary px-4">Next</a>
                        <a v-else href="#" @click.prevent="createNewProduct()" class="btn btn-primary px-4">Done</a>
                    </template>

                    <a v-else @click.prevent="$router.push('/home')" href="#" class="btn btn-outline-primary">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

import formStep1 from './steps/formStep1';
import formStep2 from './steps/formStep2';
import formStep3 from './steps/formStep3';
import formResult from './steps/formResult';

export default {
    components: {
        formStep1,
        formStep2,
        formStep3,
        formResult,
    },

    data() {
        return {
            iCurrentStep: 1,
            aCardTitleList: [
                'Step 1 - Product information',
                'Step 2 - Upload product images',
                'Step 3 - Date and time',
                'Done'
            ],
            oProduct: {
                name: '',
                description: '',
                category_id: '',
                date_time: '',
            },
            aImages: [],
            aImageToDelete: [],
            bLoading: false,
        }
    },

    computed: {
        ...mapGetters([
            'categories'
        ]),
    },

    methods: {
        ...mapActions([
            'getCategories',
            'saveProduct',
            'getProduct'
        ]),

        setProductData(oData) {
            this.oProduct.name = oData.name;
            this.oProduct.description = oData.description;
            this.oProduct.category_id = oData.category_id;
        },

        setImageData(aImages) {
            this.aImages = aImages;
        },

        setDatetime(sDatetime) {
            this.oProduct.date_time = sDatetime;
        },

        setImageToDelete(aImageToDelete) {
            this.aImageToDelete = aImageToDelete;
        },

        createNewProduct() {
            let bValid = this.next();
            if (!bValid) {
                return false;
            }

            this.bLoading = true;
            let oFormData = new FormData();

            let iProductId = this.oProduct.product_id ?? null;
            if (iProductId !== null) {
                oFormData.append('product_id', iProductId);
            }

            oFormData.append('name', this.oProduct.name);
            oFormData.append('category_id', this.oProduct.category_id);
            oFormData.append('description', JSON.stringify(this.oProduct.description));
            oFormData.append('date_time', this.oProduct.date_time);
            let imageToAddIndex = 0;
            this.aImages.forEach((data) => {
                if (data.image_path === null) {
                    oFormData.append('image_to_add[' + imageToAddIndex + ']', data.image_file);
                    imageToAddIndex++;
                    return;
                }
            });
            this.aImageToDelete.forEach((id, index) => {
                oFormData.append('image_to_delete[' + index + ']', id)
            });

            this.saveProduct(oFormData)
                .finally(() => {
                    this.bLoading = false;
                });
        },

        next() {
            let oResponse = this.$refs['step' + this.iCurrentStep].submitForm();
            if (!oResponse) {
                alert('Fill up all fields.')
                return false;
            }
            this.iCurrentStep += 1;
            return true;
        },

        previous() {
            this.iCurrentStep -= 1;
        },
    },

    mounted() {
        if (this.$route.params.id) {
            let oProduct = this.getProduct(this.$route.params.id)
                .then(data => {
                    this.oProduct = data;
                    this.aImages = data.images;
                });
        }
    },
}
</script>
