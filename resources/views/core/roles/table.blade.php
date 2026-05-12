<x-layout>

    <x-card class="table-container">

        <div class="col-md-12">

            <x-form method="GET" action="{{ moduleRoute('getTable') }}">
                <x-filter toggle="Filter" :fields="$fields" />
            </x-form>

            <x-form method="POST" action="{{ moduleRoute('getTable') }}">

                <x-action />

                <div class="container-fluid">
                    <div class="table-responsive" id="table_data">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="9" class="center">
                                        <input class="btn-check-d" type="checkbox">
                                    </th>
                                    <th class="text-center column-action">{{ __('Action') }}</th>
                                    @foreach ($fields as $value)
                                        <th {{ Template::extractColumn($value) }}>
                                            {{ __($value->name) }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $table)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkbox" name="code[]"
                                                value="{{ $table->field_primary }}">
                                        </td>
                                        <td data-label="Action" class="col-md-2 text-center column-action">
                                            <x-crud :model="$table" />
                                        </td>
                                        <td data-label="Key">{{ $table->field_key }}</td>
                                        <td data-label="Name">{{ $table->field_name }}</td>
                                        <td data-label="Level">{{ $table->field_level_name }}</td>
                                        <td data-label="Description">{{ $table->field_description }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :data="$data" />
                </div>

            </x-form>

        </div>

    </x-card>

</x-layout>