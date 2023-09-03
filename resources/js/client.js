import axios from 'axios';

let token = localStorage.getItem('X-PRIVATE-TOKEN');

const baseClient = axios.create({
    baseURL: '/admin/api',
    headers: {
        // 'Content-Type': 'application/json',
        // 'Accept': 'application/json',
        // 'Authorization': 'Bearer ' + token,
    },
});

baseClient.interceptors.response.use(
    response => {
        return response;
    },

    error => {
        if (error.response.status === 401) {
            alert('Session expired. Please login again.');
            window.location.replace('/login');
        }
        return Promise.reject(error);
    }
);

export default baseClient;
