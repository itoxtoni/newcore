@props([
    'label' => null,
    'model' => null,
    'form' => null,
    'override' => false,
])

@php
    $attributes = $attributes->class(['button button-action'])->merge([
        //
    ]);

    if ($form == null) {
        $form = 'table';
    }

@endphp

@section('action')
    @if ($form != 'disable')
        <div {{ $attributes }}>
            @if ($form == 'table')
                <input class="btn-check-m d-lg-none" type="checkbox">
                <x-button onclick="return confirm('Apakah anda yakin ingin menghapus ?')" name="delete" type="submit"
                        color="danger" label="Kosongkan" />
                <x-button :module="ACTION_CREATE" color="success" label="Buat" />
            @elseif($form == 'print')
                    <x-button name="type" value="report" type="submit" label="Print" />
            @elseif($form == 'form')
                    <x-button type="submit" label="Simpan" />
            @endif

            {{ $slot }}
        </div>
    @endif

@endsection
