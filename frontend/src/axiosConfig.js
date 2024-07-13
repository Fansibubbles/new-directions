import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.withCredentials = true;

axios.interceptors.request.use(async config => {
    await axios.get('http://localhost:8000/sanctum/csrf-cookie');
    return config;
});

export default axios;