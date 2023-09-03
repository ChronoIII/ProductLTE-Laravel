import client from '../client';

export default {
    async getUserData() {
        return await client.get('/user');
    },

    async logoutUser() {
        return await client.get('/logout');
    }
}
