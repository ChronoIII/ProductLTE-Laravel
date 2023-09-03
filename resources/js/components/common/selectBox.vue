<template>
    <div class="row mb-3">
        <label :for="camelCaseLabel" class="col-md-4 col-form-label text-md-end">{{ label }}</label>

        <div class="col-md-6">
            <div class="d-flex">
                <select v-if="options.length <= 0" class="form-control">
                    <option selected>No option available</option>
                </select>
                <select v-else v-model="input" class="form-control">
                    <template v-for="option in options">
                        <option :value="option[optionValue]">{{ option[optionShow] }}</option>
                    </template>
                </select>

                <slot></slot>
            </div>

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
        errorMessage: {
            type: String,
            default: null,
        },
        data: {
            required: true,
        },
        options: {
            type: Array,
            required: true,
        },
        optionValue: {
            type: String,
            required: true,
        },
        optionShow: {
            type: String,
            required: true,
        }
    },

    watch: {
        options(newValue) {
            this.initValues();
        }
    },

    computed: {
        camelCaseLabel() {
            return this.label.split(' ').join('-').toLowerCase();
        },

        hasError() {
            return this.errorMessage !== null;
        },

        input: {
            get() {
                return this.data;
            },
            set(val) {
                this.$emit('update:data', val);
            }
        }
    },

    methods: {
        initValues() {
            if (this.options.length >= 1) {
                this.input = this.options[0][this.optionValue];
            }
        }
    },

    mounted() {
        this.initValues();
    }
}
</script>
