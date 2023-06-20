import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
};

let url = 'http://127.0.0.1:8000/api';

export const ApiRequest = axios.create({
    baseURL: url,
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token') || '',
    },
    withCredentials: true
});

export const ApiRequestWithFile = axios.create({
    baseURL: url,
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token') || '',
        'Content-Type': 'multipart/form-data'
    },
    withCredentials: true
});

export const ApiRequestWithoutAuth = axios.create({
    baseURL: url,
    withCredentials: true
});