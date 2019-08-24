<script>

    import { config } from './stores/config_write';

    // Set the config from the frontend.
    export let CONFIG;
    config.update(value => CONFIG);

</script>

<div class="container m-4 mx-auto">
    <div class="flex flex-row">

    </div>
</div>
