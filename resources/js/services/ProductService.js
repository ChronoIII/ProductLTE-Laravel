import client from '../client';

export default {
    async getProducts(aFilters) {
        // filters
        const params = '?' + new URLSearchParams(aFilters).toString();
        return await client.get('/products' + params);
    },

    async getProduct(iProductId) {
        return await client.get('/products/' + iProductId);
    },

    async saveProduct(oProduct) {
        return await client.post('/products', oProduct, {
            'Content-Type': 'multipart/form-data'
        });
    },

    async deleteProduct(iProductId) {
        return await client.delete('/products' + iProductId);
    }
}
