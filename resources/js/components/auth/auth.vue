<template>
    <div class="wrapper">
        <nav-bar />

        <main v-if="!isAuthenticated" class="content-wrapper pt-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ pageName }}</div>

                            <div class="card-body">
                                <router-view></router-view>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import navBar from '../common/navBar';

export default {
    components: {
        navBar,
    },

    computed: {
        pageName() {
            return this.$route.name;
        }
    },
}
</script>
