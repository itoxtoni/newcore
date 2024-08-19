<x-layout>

    <x-card class="table-container">

        <div class="col-md-12">

            <x-form method="GET" action="{{ moduleRoute('getTable') }}">
                <x-filter toggle="Filter" :fields="$fields" />
            </x-form>

            <x-form method="POST" action="{{ moduleRoute('getTable') }}">

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                  </div>


                <x-action>
                    <x-button type="submit" label="Sort" name="sort" />
                </x-action>

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
                                            @if ($value->sort)
                                                @sortablelink($value->code, __($value->name))
                                            @else
                                                {{ __($value->name) }}
                                            @endif
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
                                        <td class="col-md-2 text-center column-action">
                                            <x-crud :model="$table" />
                                        </td>
                                        <td>{{ $table->field_primary }}</td>
                                        <td>{{ $table->field_name }}</td>
                                        <td>{{ $table->field_icon }}</td>
                                        <td>{{ $table->field_url }}</td>
                                        <td class="text-center">
                                            <x-form-input name="sort[{{ $table->field_primary }}]" :label="false"
                                                col="false" value="{{ $table->field_sort }}" />
                                        </td>
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