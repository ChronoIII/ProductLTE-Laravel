<template>
    <table v-if="products.data?.length >= 1" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Date and Time</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="product in products.data" :key="product.product_id">
                <td>{{ product.product_id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.category.name }}</td>
                <td>{{ product.date_time }}</td>
                <td class="d-flex justify-content-center">
                    <button @click.prevent="$router.push('/product/update/' + product.product_id)" type="button" class="btn btn-link btn-sm btn-rounded">
                        Edit
                    </button>

                    <button type="button" class="btn btn-link btn-sm btn-rounded">
                        Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <div v-else>
        <p class="text-center my-3">No product to show</p>
    </div>
</template>

<script>

export default {
    props: {
        products: {
            type: Object,
            required: true,
        }
    }
}
</script>
