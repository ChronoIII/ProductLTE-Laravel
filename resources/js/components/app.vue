<template>
    <div class="wrapper">
        <nav-bar />
        <side-bar />

        <main class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ pageName }}</h1>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <template v-for="breadcrumb in breadCrumbs">
                                    <li class="breadcrumb-item">{{ breadcrumb }}</li>
                                </template>
                            </ol>
                        </div>
                    </div>

                    <div class="mt-3">
                        <router-view :key="$route.fullPath"></router-view>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import navBar from './common/navBar';
import sideBar from './common/sideBar';

export default {
    components: {
        navBar,
        sideBar,
    },

    computed: {
        ...mapGetters([
            'user',
        ]),

        pageName() {
            return this.$route.name;
        },

        isAuthenticated() {
            return this.user !== null;
        },

        breadCrumbs() {
            return this.$route.meta.breadcrumb;
        }
    },

    methods: {
        ...mapActions([
            'getUserData',
            'getProducts',
            'getCategories'
        ]),
    },

    beforeMount() {
        this.getUserData();
        this.getProducts();
        this.getCategories();
    },
}
</script>
