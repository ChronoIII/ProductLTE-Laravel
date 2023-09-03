<template>
    <form>
        <text-box
            v-model:data="oCredentials.id"
            label="Username"
            type="text" />

        <text-box
            v-model:data="oCredentials.password"
            label="Password"
            type="password" />

        <div class="row mb-3">
            <div class="col-md-8 offset-md-4">
                <div class="form-check">
                    <input v-model="oCredentials.remember" type="checkbox" name="remember" id="remember" class="form-check-input">

                    <label for="remember" class="form-check-label">Remember Me?</label>
                </div>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-8 offset-lg-3 offset-xl-4">
                <button @click.prevent="attemptLogin()" type="submit" class="btn btn-primary">
                    Login
                </button>

                <a @click.prevent="$router.push('/register')" href="#" class="btn btn-link">
                    Don't have an account yet?
                </a>
            </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';
import textBox from '../../common/textBox';

export default {
    components: {
        textBox,
    },

    data() {
        return {
            oCredentials: {
                id: '',
                password: '',
                remember: false,
            },
            oErrors: {
                id: '',
                password: ''
            },
            bIsLoading: false,
        }
    },

    computed: {
        ...mapGetters([
            'user',
        ]),
    },

    methods: {
        validateInputs() {
            if (!this.oCredentials.id || !this.oCredentials.password) {
                alert('Id / Password are required');
                return false;
            }
            return true;
        },

        attemptLogin() {
            if (this.bIsLoading || !this.validateInputs()) {
                return;
            }

            this.bIsLoading = true;
            axios.post('/admin/api/login', this.oCredentials)
                .then((res) => {
                    let oData = res.data.data;
                    this.enterDashboard(oData);
                })
                .catch((err) => {
                    let error = err.response.data.message;
                    alert(error);
                })
                .finally(() => {
                    this.bIsLoading = false;
                })
        },

        enterDashboard(oUserData) {
            location.replace('/home');
        }
    },
}
</script>
