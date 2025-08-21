<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.meta')

<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles

    <script src="{{ url('assets/js/test-turbo.js') }}"></script>
    <style>
        .navigation .navigation-menu-tab ul li, .navigation .navigation-menu-tab   {
            background-color: {{ env('APP_COLOR') ?? '#1565C0' }} !important;
        }

        .navigation .navigation-menu-body ul li>a.active{
            color: {{ env('APP_COLOR') ?? '#1565C0' }} !important;
        }

        .navigation .navigation-menu-body ul li.open>a{
            color: {{ env('APP_COLOR') ?? '#1565C0' }} !important;
        }

        .navigation .navigation-menu-body ul li>a:hover{
            color: {{ env('APP_COLOR') ?? '#1565C0' }} !important;
        }
    </style>


        function domReady(fn) {
            if (
                document.readyState === "complete" ||
                document.readyState === "interactive"
            ) {
                setTimeout(fn, 1000);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        domReady(function () {
            console.log("DOM is ready");
            // If found you qr code
            function onScanSuccess(decodeText, decodeResult) {
                alert("You Qr is : " + decodeText, decodeResult);
            }

            let htmlscanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbos: 250 }
            );
            htmlscanner.render(onScanSuccess);
        });
        </script>

</head>

<body class="fixed" data-turbo-prefetch="false">

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

    @stack('footer')

    @livewireScriptConfig

    <script
        src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js">
    </script>

    <script>
        // script.js file

function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {

    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
        alert("You Qr is : " + decodeText, decodeResult);
    }

    let htmlscanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbos: 250 }
    );
    htmlscanner.render(onScanSuccess);
});
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="{{ @asset('vendor/qrcode/qrcode-reader.min.css') }}">
        <script src="{{ @asset('vendor/qrcode/qrcode-reader.min.js') }}"></script>

        <script>

            Jquery = $;

             $("#detail").qrCodeReader({
                    audioFeedback: true,
                    multiple: false,
                    skipDuplicates: true,
                    callback: function(codes) {
                        var code = codes.split('=');
                        window.location.replace("url?id=" + code[1]);
                    }
                });

            </script>

</body>

</html>

