import axios, { AxiosError } from 'axios';
import { useAuthStore } from '../store/auth';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

let url = 'http://localhost:8000/api';
//let url = 'https://prototype.ziptravel.com.ph/api';
//let url = 'https://ziptravel.com.ph/api';

export const ApiRequest = axios.create({
    baseURL: url,
    headers: {
        'Content-Type': 'application/json'
    },
    withCredentials: true
});

export const ApiRequestWithFile = axios.create({
    baseURL: url,
    headers: {
        'Content-Type': 'multipart/form-data'
    },
    withCredentials: true
});

export const ApiRequestWithoutAuth = axios.create({
    baseURL: url,
    withCredentials: true
});

ApiRequest.interceptors.request.use((config) => {
    const authStore = useAuthStore();

    config.headers['Authorization'] = `Bearer ${authStore.accessToken}`;
    return config;
});

ApiRequestWithFile.interceptors.request.use((config) => {
    const authStore = useAuthStore();

    config.headers['Authorization'] = `Bearer ${authStore.accessToken}`;
    return config;
});
