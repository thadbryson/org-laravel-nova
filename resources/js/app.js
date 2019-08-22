/**
 * Widgets
 */

import App from './AppExample.svelte';

export default new App({
    target: document.body,
    props: {
        CONFIG: JSON.parse(CONFIG)
    }
});
