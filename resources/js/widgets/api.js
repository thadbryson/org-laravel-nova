import axios from 'axios';
import { CONFIG } from '../stores/config';

/**
 * Alter Requests
 */
axios.interceptors.request.use(function (request) {

    request.headers['token-api'] = CONFIG.token;
    request.headers['user-id']   = CONFIG.user.id;

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
