import axiosLib, { AxiosError } from 'axios'
import { useGlobalNotification } from "./composables/globalNotification";
const { showNotify, closeNotify } = useGlobalNotification();

let notifyIndex = 0;

const axios = axiosLib.create({
    baseURL: '/',
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
    },
});

axios.defaults.withCredentials = true // разрешить отправку куки

axios.interceptors.request.use(async (config) => {
    if (config.method.toLowerCase() !== 'get') {
        await axios.get('/csrf-cookie').then();
        config.headers['X-XSRF-TOKEN'] = await cookieStore.get('XSRF-TOKEN');
    }

    config.headers['X-XSRF-TOKEN'] = await cookieStore.get('XSRF-TOKEN');

    notifyIndex = showNotify('Пожайлуста, ожидайте...', "wait");

    return config;
});

axios.interceptors.response.use(async (response) => {

    closeNotify(notifyIndex);

    return response;

}, async (error) => {
    let data = error.response.data;

    if (data.errors) {
        for (const key in data.errors) {
            if (!Object.hasOwn(data.errors, key)) continue;

            const error = data.errors[key];

            showNotify(error[0], "error", 3500);
        }
    } else if (data.message) {
        showNotify(data.message, "error", 3500);
    }

    return Promise.reject(error);

})

export default axios;