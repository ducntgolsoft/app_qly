/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import flatpickr from "flatpickr";
window.flatpickr = flatpickr;

import ApexCharts from 'apexcharts'
window.ApexCharts = ApexCharts;


// import { initializeApp } from "firebase/app";
// import { getAnalytics } from "firebase/analytics";

// const firebaseConfig = {
//     apiKey: "AIzaSyAje_Pe7S9OF-XumkuH3MjpWhsnu7b0B5g",
//     authDomain: "ducdev-912b3.firebaseapp.com",
//     projectId: "ducdev-912b3",
//     storageBucket: "ducdev-912b3.appspot.com",
//     messagingSenderId: "257189660626",
//     appId: "1:257189660626:web:d7f2f3cdd83e20eed06a0b",
//     measurementId: "G-QWB29NH71Y"
// };

// const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);


import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

var pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'ap1',
    encrypted: true
});
window.pusher = pusher;
