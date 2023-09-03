<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="" class="brand-link">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">

            <span class="brand-text font-weight-light">AdminLTE</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">NAVIGATION</li>
                    <li :class="['nav-item', {'menu-is-opening menu-open': this.activePage.includes('Product')}]">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-house"></i>
                            <p>
                                Products
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a @click.prevent="$router.push('/home')" href="#" :class="['nav-link', { 'active': activePage === 'Products' }]">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a @click.prevent="$router.push('/product/add')" href="#" :class="['nav-link', { 'active': activePage === 'Create New Product' }]">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create New Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a @click.prevent="$router.push('/category')" href="#" :class="['nav-link', { 'active': activePage === 'Categories' }]">
                            <i class="fa-solid fa-box nav-icon"></i>

                            <p>Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @click.prevent="$router.push('/video-player')" href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-film"></i>

                            <p>Video Player</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>

export default {
    computed: {
        activePage() {
            return this.$route.name ?? '';
        }
    }
}
</script>
