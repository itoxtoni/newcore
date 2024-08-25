<!doctype html>
<html lang="en">
@include('layouts.meta')

<head>
    @vite(['resources/sass/app.scss'])
    @livewireStyles
</head>

<body class="fixed">

    @include('layouts.header')

    <div id="main">

        <div class="navigation">

            @include('layouts.left')

        </div>

        <div class="main-content" id="content">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>

    </div>

    @include('layouts.alert')

    <script src="{{ url('assets/js/app.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('footer')

    @vite(['resources/js/vite.js'])
    @livewireScriptConfig
    @livewire('notification')
    <x-livewire-alert::scripts />
</body>

</html>

