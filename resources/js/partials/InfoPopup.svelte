<script>

    export let labelXs = true;
    export let label   = 'Info';
    export let inline = false;

    let hide = true;

</script>

<div class="cursor-pointer"
        class:text-xs={ labelXs }
        class:inline={ inline }
        on:mouseenter={ () => hide = false }
        on:mouseleave={ () => hide = true }>
    <i class="fas fa-caret-down"></i>
    {@html label }
</div>

<div class:hidden={ hide }
    on:mouseenter={ () => hide = false }
    on:mouseleave={ () => hide = true }
    class="absolute text-black bg-white p-3 z-50 rounded border shadow">
    <slot></slot>
</div>
