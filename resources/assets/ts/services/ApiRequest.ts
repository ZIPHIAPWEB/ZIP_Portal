import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
};

export const ApiRequest = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token') || ''
    },
    withCredentials: true
});

export const ApiRequestWithoutAuth = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
    withCredentials: true
});