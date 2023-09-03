<template>
    <div class="row">
        <label :for="camelCaseLabel" class="col-md-4 col-form-label text-md-end">{{ label }}</label>
    </div>

    <QuillEditor
        ref="quill"
        theme="snow"
        @update:content="updateContent"
        content-type="delta" />
</template>

<script>
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    props: {
        label: {
            type: String,
            required: true,
        },
        errorMessage: {
            type: String,
            default: null,
        },
        dataTest: {
            required: true,
            default: {
                ops: []
            },
        }
    },

    emits: [
        'read-content'
    ],

    data() {
        return {
            value: {
                ops: []
            },
        }
    },

    watch: {
        dataTest(newVal) {
            if (newVal !== null) {
                this.$refs['quill'].setContents(newVal.ops);
            }
        }
    },

    components: {
        QuillEditor,
    },

    computed: {
        camelCaseLabel() {
            return this.label.split(' ').join('-').toLowerCase();
        },

        hasError() {
            return this.errorMessage !== null;
        },
    },

    methods: {
        updateContent() {
            this.value = this.$refs['quill'].getContents();
            // this.$emit('update:dataTest', this.$refs['quill'].getContents());
        },

        readContent() {
            this.$emit('read-content', this.value);
        }
    }
}
</script>
