<template>
    <div class="row mb-3">
        <label :for="camelCaseLabel" class="col-md-4 col-form-label text-md-end">{{ label }}</label>

        <div class="col-md-8">
            <input v-model="input" :type="type" :id="camelCaseLabel" :name="camelCaseLabel" :class="['form-control', { 'is-invalid' : hasError }]" :autocomplete="camelCaseLabel">

            <span v-if="hasError" class="invalid-feedback" role="alert">
                <strong>{{ errorMessage ?? '' }}</strong>
            </span>
        </div>
    </div>
</template>

<script>
export default {
    model: {
        prop: 'data',
        event: 'change',
    },

    props: {
        label: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            default: 'text',
        },
        errorMessage: {
            type: String,
            default: null,
        },
        data: {
            type: String,
            required: true,
        }
    },

    computed: {
        camelCaseLabel() {
            return this.label.split(' ').join('-').toLowerCase();
        },

        hasError() {
            return !(this.errorMessage === '' || this.errorMessage === null);
        },

        input: {
            get() {
                return this.data;
            },
            set(val) {
                this.$emit('update:data', val);
            }
        }
    }
}
</script>
