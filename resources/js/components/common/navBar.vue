<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul v-if="isAuthenticated" class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link" data-widget="pushmenu" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <a href="#" class="navbar-brand ml-2">AdminLTE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <template v-if="!isAuthenticated">
                    <li class="nav-item">
                        <a @click.prevent="navigateTo('/login')" class="nav-link" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a @click.prevent="navigateTo('/register')" class="nav-link" href="#">Register</a>
                    </li>
                </template>

                <template v-else>
                    <li class="nav-item">
                        <a @click.prevent="logout" class="nav-link" href="#">Logout</a>
                    </li>
                </template>
            </ul>
        </div>
    </nav>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters([
            'user',
        ]),

        isAuthenticated() {
            return this.user !== null;
        }
    },

    methods: {
        ...mapActions([
            'logoutUser'
        ]),

        navigateTo(sPath) {
            location.replace(sPath);
        },

        async logout() {
            await this.logoutUser();
            location.replace('/login');
        }
    }
}
</script>
