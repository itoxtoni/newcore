<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize JavaScript functions after the DOM is fully loaded
        test();

    });

    // Run when Turbo visits a new page
    document.addEventListener("turbo:load", function () {
        // initialClick();
        test();
    });

    // Optional: Handle when Turbo renders a frame
    document.addEventListener("turbo:render", function () {
        test();
    });

    function test() {
        var toastr = new Notif({
            duration: 5000,
            dismissible: true,
            position: {
                x: 'right',
                y: 'top',
            },
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @php
                    $string = Str::of($error);
                    $required = ' wajib diisi';
                    if ($string->contains($required)) {
                        $error = formatAttribute($string->before($required)) . $required ?? $error;
                    }
                @endphp
                toastr.error('{{ $error }}');
            @endforeach
        @endif

        @if (session()->has('success') && !request()->ajax())
            toastr.success("{{ session()->get('success') }}");
            @php
                session()->forget('success');
            @endphp
        @endif
    }

</script>
