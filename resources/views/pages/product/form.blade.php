<x-layout>
    <x-form :model="$model">
        <x-card>
            <x-action form="form" />

            <div class="row">
                @bind($model)

                <x-form-input col="6" name="product_nama" />
                <x-form-input col="6" name="product_sku" />
                <x-form-input col="6" name="product_barcode" />
                <x-form-input col="6" name="product_id_category" />
                <x-form-input col="6" name="product_tag" />
                <x-form-input col="6" name="product_description" />
                <x-form-input col="6" name="product_satuan" />
                <x-form-input col="6" name="product_harga" />

                @endbind
            </div>

        </x-card>
    </x-form>
</x-layout>
