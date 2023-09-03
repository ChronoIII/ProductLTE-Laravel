<template>
    <div>
        <div class="row d-flex flex-column">
            <button @click.prevent="openFileViewer()" class="btn btn-outline-primary">Upload an image</button>

            <input @change="saveTempImages($event)" ref="file_input" type="file" name="file" class="d-none" multiple accept="image/*">
        </div>

        <div v-if="aImages.length >= 1" class="d-flex flex-wrap">
            <template v-for="(imageFile, index) in aImages">
                <div class="image-container mr-2" @click.prevent="removeTempImages(index)">
                    <img :src="viewImage(imageFile)" id="preview" class="img-thumbnail" style="height: 100px;">
                </div>
            </template>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        images: {
            type: Array,
            default: null,
        }
    },

    data() {
        return {
            aImages: [],
            aImageToDelete: [],
        }
    },

    watch: {
        images(newVal) {
            if (newVal !== null) {
                this.aImages = newVal;
            }
        }
    },

    methods: {
        openFileViewer() {
            this.$refs['file_input'].click();
        },

        saveTempImages(evt) {
            let aLength = evt.target.files.length;
            for (let i = 0; i < aLength; i++) {
                this.aImages.push({
                    product_image_id: null,
                    image_file: evt.target.files[i],
                    image_path: null,
                });
            }
        },

        removeTempImages(iIndex) {
            if (this.aImages[iIndex].product_image_id !== null) {
                this.aImageToDelete.push(this.aImages[iIndex].product_image_id);
            }
            this.aImages.splice(iIndex, 1);
        },

        viewImage(imageFile) {
            if (imageFile.image_path !== null) {
                return imageFile.image_path;
            }
            return URL.createObjectURL(imageFile.image_file);
        },

        submitForm() {
            if (this.aImages.length >= 1) {
                this.$emit('image-data', this.aImages);
                this.$emit('image-to-delete', this.aImageToDelete);
                return true;
            }
            return false;
        }
    }
}
</script>

<style>
.image-container {
    position: relative;
}

.image-container:hover:before {
    content: '❌';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 100;
}

.image-container:hover:after {
    content: '';
    background: #000000a1;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
</style>
