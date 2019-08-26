import axios from 'axios';
import { CONFIG } from '../stores/config';

/**
 * Alter Requests
 */
axios.interceptors.request.use(function (request) {

    CONFIG.user = CONFIG.user || {};

    request.headers['token-api'] = CONFIG.token || null;
    request.headers['user-id']   = CONFIG.user.id || null;

    return request;
});

/**
 * Alter Responses
 */
axios.interceptors.response.use(function (response) {

    const messages = response.data.messages || [];

    if (messages.length > 0) {

    }

    return response.data.data || {};

}, function (error) {

    return Promise.reject(error);
});

export default axios;
