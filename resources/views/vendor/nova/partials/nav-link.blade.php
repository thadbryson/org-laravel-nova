@php

    $pad = ($pad ?? true);
    $pad = $pad === true ? 'ml-8' : '';

    // On a blank page? - begins with '@'
    $isBlankPage = $to[0] === '@';

    $to = ltrim($to, '@');

@endphp

@if (class_exists($to))
    <router-link :to="{ name: 'index', params: { resourceName: '{{ $to::uriKey() }}' } }"
                 @if ($isBlankPage) target="_blank" @endif
                 class="text-white {{ $pad }} no-underline dim">
        {{ __($title) }}
    </router-link>
@elseif (substr($to, 0, 5) === 'http:' || substr($to, 0, 6) === 'https:' || $to[0] === '/')
    <a href="{{ $to }}" class="text-white {{ $pad }} no-underline dim" @if ($isBlankPage) target="_blank" @endif>
        {{ __($title) }}
    </a>
@else
    <router-link :to="{ name: '{{ $to }}' }"
                 class="text-white {{ $pad }} no-underline dim">
        {{ __($title) }}
    </router-link>
@endif
