<script>

	export let labelXs = true;
	export let label   = 'Info';
	export let inline  = false;

	let hide = true;

</script>

<div class="cursor-pointer"
     class:text-xs={ labelXs }
     class:inline={ inline }
     on:mouseenter={ () => hide = false }
     on:mouseleave={ () => hide = true }>
    <svg class="svg-inline--fa fa-caret-down fa-w-10" data-fa-i2svg="" data-icon="caret-down" data-prefix="fas"
         focusable="false" role="img" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
              fill="currentColor"></path>
    </svg>

    {@html label }
</div>

<div class:hidden={ hide }
     on:mouseenter={ () => hide = false }
     on:mouseleave={ () => hide = true }
     class="absolute text-black bg-white p-3 z-50 rounded border shadow">
    <slot></slot>
</div>
