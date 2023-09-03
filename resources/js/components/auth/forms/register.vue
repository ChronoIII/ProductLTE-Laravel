<template>
    <form>
        <text-box
            label="Name"
            type="text"
            v-model:data="oUserData.name"
            :error-message="oErrors.name" />

        <text-box
            label="Username"
            type="text"
            v-model:data="oUserData.username"
            :error-message="oErrors.username" />

        <text-box
            label="Email"
            type="text"
            v-model:data="oUserData.email"
            :error-message="oErrors.email" />

        <text-box
            label="Password"
            type="password"
            v-model:data="oUserData.password"
            :error-message="oErrors.password" />

        <text-box
            label="Confirm Password"
            v-model:data="oUserData.password_confirmation"
            type="password" />

        <div class="row mb-0">
            <div class="col-md-12">
                <button @click.prevent="attemptRegister()" type="submit" class="btn btn-primary mx-auto d-md-block px-4">
                    Register
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import textBox from '../../common/textBox';

export default {
    components: {
        textBox,
    },

    data() {
        return {
            oUserData: {
                name: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            oErrors: {
                name: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            bIsLoading: false,
        }
    },

    methods: {
        validateInputs() {
            let bValid = true;
            let aKeys = Object.keys(this.oErrors);
            aKeys.forEach(sKey => {
                if (!this.oUserData[sKey]) {
                    bValid = false;
                    return this.oErrors[sKey] = 'The ' + sKey + ' field is required.';
                }
                this.oErrors[sKey] = '';
            });
            return bValid;
        },

        attemptRegister() {
            if (this.bIsLoading || !this.validateInputs()) {
                return;
            }

            this.bIsLoading = true;
            axios.post('/admin/api/register', this.oUserData)
                .then((res) => {
                    let oData = res.data.data;
                    this.enterDashboard(oData);
                })
                .catch((err) => {
                    let oError = err.response.data;
                    let aKeys = Object.keys(oError.errors);
                    aKeys.forEach(sKey => {
                        this.oErrors[sKey] = oError.errors[sKey][0];
                    });
                })
                .finally(() => {
                    this.bIsLoading = false;
                })
        }
    },
}
</script>
