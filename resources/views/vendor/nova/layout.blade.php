<!DOCTYPE html>
<html lang="en" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Nova::name() }}</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-6jHF7Z3XI3fF4XZixAuSu0gGKrXwoX/w3uFPxC56OtjChio7wtTGJWRW53Nhx6Ev"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i"
          rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="{{ asset('vendor/nova/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nova.css') }}">

    <!-- Tool Styles -->
    @foreach(Nova::availableStyles(request()) as $name => $path)
        <link rel="stylesheet" href="/nova-api/styles/{{ $name }}">
    @endforeach
</head>
<body class="min-w-site bg-40 text-black min-h-full">
    <div id="nova">
        <div v-cloak class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="min-h-screen flex-none pt-header min-h-screen w-sidebar bg-grad-sidebar px-6">

                @include('vendor.nova.partials.logo-link')

                @foreach(config('nova-nav', []) as $heading => $links)

                    @if (is_string($links))

                        @if (is_string($heading))
                            <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
                                <span class="sidebar-label">
                                    @include('nova::partials.nav-link', [
                                        'title' => $heading,
                                        'to'    => $links,
                                        'pad'   => false
                                    ])
                                </span>
                            </h3>
                        @endif

                    @else

                        @if (is_string($heading))
                            <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
                                <span class="sidebar-label">{{ $heading }}</span>
                            </h3>
                        @endif

                        @if (count($links) > 0)
                            <ul class="list-reset mb-8">
                                @foreach($links as $title => $to)

                                    <li class="leading-wide mb-4 text-sm">

                                        @include('nova::partials.nav-link', [
                                            'title' => $title,
                                            'to'    => $to
                                        ])
                                    </li>

                                @endforeach
                            </ul>
                        @endif

                    @endif

                @endforeach

            </div>

            <!-- Content -->
            <div class="content">
                <div class="flex items-center relative shadow h-header bg-white z-20 px-6">
                    @if (count(Nova::globallySearchableResources(request())) > 0)
                        <global-search></global-search>
                    @endif

                    <dropdown class="ml-auto h-9 flex items-center" style="right: 20px">
                        @include('nova::partials.user')
                    </dropdown>
                </div>

                <div data-testid="content" class="px-view py-view mx-auto">
                    @yield('content')

                    <p class="mt-8 text-center text-xs text-80">
                        &copy; {{ date('Y') }}
                        |
                        {{ Config::get('nova.copyright', '') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.config = @json(Nova::jsonVariables(request()));
    </script>

    <!-- Scripts -->
    <script src="{{ mix('manifest.js', 'vendor/nova') }}"></script>
    <script src="{{ mix('vendor.js', 'vendor/nova') }}"></script>
    <script src="{{ mix('app.js', 'vendor/nova') }}"></script>

    <!-- Build Nova Instance -->
    <script>
        window.Nova = new CreateNova(config)
    </script>

    <!-- Tool Scripts -->
    @foreach (Nova::availableScripts(request()) as $name => $path)
        @if (\Tool\StrStatic::startsWithAny($path, ['http://', 'https://']))
            <script src="{!! $path !!}"></script>
        @else
            <script src="/nova-api/scripts/{{ $name }}"></script>
    @endif
@endforeach

<!-- Start Nova -->
    <script>
        Nova.liftOff()
    </script>
</body>
</html>
