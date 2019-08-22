<script>

    import { config } from './stores/config_write';

    // Set the config from the frontend.
    export let CONFIG;
    config.update(value => CONFIG);

    import Calendar from './components/Calendar/Calendar.svelte';
    import Card from './components/Partials/Card.svelte';
    import Clock from './components/Clock.svelte';
    import Lights from './components/Lights.svelte';
    import Links from './components/Links.svelte';
    import Themes from './components/Themes.svelte';
    import Thermostat from './components/Thermostat.svelte';
    import Traffic from './components/Traffic.svelte';
    import Weather from './components/Weather.svelte';

</script>

<div class="container m-4 mx-auto">
    <div class="flex flex-row">
        <Card>
            <Clock />
        </Card>
        <Card>
            <Weather />
        </Card>
        <Card>
            <Thermostat />
        </Card>
        <Card>
            <Links />
        </Card>
    </div>

    <div class="flex flex-row">
        <Card className="flex-1 w-1/3 px-2 py-4">
            <Traffic />
        </Card>
        <Card>
            <Calendar />
        </Card>
        <Card>
            <Lights />

            <Themes />
        </Card>
    </div>
</div>
