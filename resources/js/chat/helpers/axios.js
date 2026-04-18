import axios from "axios";
import router from "../router";
import store from "../store"

const axiosClient = axios.create({
    baseURL: process.env.MIX_CHAT_URL
})

axiosClient.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${store.state.user.access_token}`
    return config;
})

axiosClient.interceptors.response.use(response => {
    return response;
}, async error => {
    if (error.response.status === 401) {
        await store.commit('LOGOUT');
        await router.push({name: 'Login'})
    }
    throw error;
})

export default axiosClient;
