
import './util/fullscreen';     // Add utilities here.

import App from './App.svelte';

export default new App({
    target: document.body,
    props: {
        CONFIG: JSON.parse(CONFIG)
    }
});
