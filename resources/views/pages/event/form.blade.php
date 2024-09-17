<x-layout>
    <x-form :model="$model" :upload="true">
        <x-card>
            <x-action form="form" />

            <div class="row">
                @bind($model)

                <x-form-input col="6" name="event_name" />
                <x-form-input type="number" col="6" name="event_price" />
                <x-form-input col="6" type="date" name="event_date" />
                <x-form-input col="6" name="event_info" />
                <x-form-input col="6" name="event_description" />

                <x-form-upload col="3" name="images" />
                @if($model)
                <div class="col-md-3">
                    <img class="img-thumbnail img-fluid"
                        src="{{ $model ? url('storage/files/event/' . $model->event_image) : url('assets/media/image/logo.png') }}"
                        alt="">
                </div>
                @endif

                @endbind
            </div>

        </x-card>
    </x-form>
</x-layout>
