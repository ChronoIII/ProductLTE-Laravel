import client from '../client';

export default {
    async getCategories() {
        return await client.get('/categories');
    },

    async saveCategory(oCategory) {
        return await client.post('/categories', oCategory);
    }
}
