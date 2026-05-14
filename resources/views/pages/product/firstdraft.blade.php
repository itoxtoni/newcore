<x-layout>

    <x-card class="table-container">

        <div class="col-md-12" style="width:100%">

            <x-form method="GET" x-init="" x-target="table" role="search" aria-label="Products"
                autocomplete="off" action="{{ moduleRoute('getTable') }}">
                <x-filter toggle="Filter" :fields="$fields" />
            </x-form>

            <!-- Category Tab Filter -->
            <div class="wh-filter-tabs" id="whFilterTabs">
                <button class="wh-tab active" onclick="switchTab(this, 'tab-all')" type="button">
                    <i class="bi bi-boxes"></i> All Items
                </button>
                <button class="wh-tab" onclick="switchTab(this, 'tab-cat1')" type="button">
                    <i class="bi bi-box-seam"></i> Category 1
                </button>
                <button class="wh-tab" onclick="switchTab(this, 'tab-cat2')" type="button">
                    <i class="bi bi-archive"></i> Category 2
                </button>
                <button class="wh-tab" onclick="switchTab(this, 'tab-cat3')" type="button">
                    <i class="bi bi-inbox"></i> Category 3
                </button>
                <button class="wh-tab" onclick="switchTab(this, 'tab-cat4')" type="button">
                    <i class="bi bi-truck"></i> Category 4
                </button>
                <button class="wh-tab" onclick="switchTab(this, 'tab-cat5')" type="button">
                    <i class="bi bi-gear"></i> Category 5
                </button>
            </div>

            <x-form method="POST" action="{{ moduleRoute('getTable') }}">

                <x-action />

                <div id="table">

                    <div class="tab-content" id="categoryTabContent">

                        <!-- All Items -->
                        <div class="tab-pane show active" id="tab-all" role="tabpanel">
                            <div class="row">
                                @forelse($data as $table)
                                    @php $tagColors = ['primary','success','warning','info','danger','secondary']; @endphp
                                    @php $tagColor = $tagColors[array_rand($tagColors)]; @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 wh-col-item">
                                        <div class="wh-card">
                                            <!-- Header -->
                                            <div class="wh-card-header">
                                                <span class="wh-id">#{{ $table->product_id }}</span>
                                                <span class="wh-tag badge bg-{{ $tagColor }}">{{ $table->product_tag ?? 'General' }}</span>
                                            </div>
                                            <!-- Image -->
                                            <div class="wh-card-image">
                                                <img src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="wh-card-actions">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-light" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-danger btn-delete" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Body -->
                                            <div class="wh-card-body">
                                                <h6 class="wh-product-name" title="{{ $table->product_nama }}">
                                                    {{ $table->product_nama }}
                                                </h6>

                                                <div class="wh-detail-grid">
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">SKU</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_sku) }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Barcode</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_barcode ?? '-') }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Category</span>
                                                        <span class="wh-detail-value">{{ $table->product_id_category ?? '-' }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Unit</span>
                                                        <span class="wh-detail-value">{{ $table->product_satuan ?? '-' }}</span>
                                                    </div>
                                                </div>

                                                <p class="wh-description">
                                                    {{ \Illuminate\Support\Str::limit($table->product_description ?? '', 80) }}
                                                </p>

                                                <div class="wh-card-footer">
                                                    <div class="wh-price">
                                                        <small class="text-muted">Price</small>
                                                        <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                                    </div>
                                                    <div class="wh-stock-indicator">
                                                        <i class="bi bi-pallet"></i>
                                                        <span>In Stock</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center" style="padding:60px 0; color:#6c757d;">
                                        <i class="bi bi-box-seam" style="font-size:4rem; opacity:0.3;"></i>
                                        <p class="mt-3" style="font-size:1.1rem;">No inventory items found</p>
                                        <small>Add products to your warehouse inventory</small>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 1 -->
                        <div class="tab-pane" id="tab-cat1" role="tabpanel">
                            <div class="row">
                                @forelse($data->take(8) as $table)
                                    @php $tagColors = ['primary','success','warning','info','danger','secondary']; @endphp
                                    @php $tagColor = $tagColors[array_rand($tagColors)]; @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 wh-col-item">
                                        <div class="wh-card">
                                            <div class="wh-card-header">
                                                <span class="wh-id">#{{ $table->product_id }}</span>
                                                <span class="wh-tag badge bg-{{ $tagColor }}">{{ $table->product_tag ?? 'General' }}</span>
                                            </div>
                                            <div class="wh-card-image">
                                                <img src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="wh-card-actions">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-light" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-danger btn-delete" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="wh-card-body">
                                                <h6 class="wh-product-name" title="{{ $table->product_name ?? $table->product_nama }}">
                                                    {{ $table->product_nama }}
                                                </h6>
                                                <div class="wh-detail-grid">
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">SKU</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_sku) }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Barcode</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_barcode ?? '-') }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Category</span>
                                                        <span class="wh-detail-value">{{ $table->product_id_category ?? '-' }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Unit</span>
                                                        <span class="wh-detail-value">{{ $table->product_satuan ?? '-' }}</span>
                                                    </div>
                                                </div>
                                                <p class="wh-description">
                                                    {{ \Illuminate\Support\Str::limit($table->product_description ?? '', 80) }}
                                                </p>
                                                <div class="wh-card-footer">
                                                    <div class="wh-price">
                                                        <small class="text-muted">Price</small>
                                                        <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                                    </div>
                                                    <div class="wh-stock-indicator">
                                                        <i class="bi bi-pallet"></i>
                                                        <span>In Stock</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center" style="padding:60px 0; color:#6c757d;">
                                        <i class="bi bi-box-seam" style="font-size:4rem; opacity:0.3;"></i>
                                        <p class="mt-3">No items in this category</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 2 -->
                        <div class="tab-pane" id="tab-cat2" role="tabpanel">
                            <div class="row">
                                @forelse($data->skip(8)->take(8) as $table)
                                    @php $tagColors = ['primary','success','warning','info','danger','secondary']; @endphp
                                    @php $tagColor = $tagColors[array_rand($tagColors)]; @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 wh-col-item">
                                        <div class="wh-card">
                                            <div class="wh-card-header">
                                                <span class="wh-id">#{{ $table->product_id }}</span>
                                                <span class="wh-tag badge bg-{{ $tagColor }}">{{ $table->product_tag ?? 'General' }}</span>
                                            </div>
                                            <div class="wh-card-image">
                                                <img src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="wh-card-actions">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-light" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-danger btn-delete" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="wh-card-body">
                                                <h6 class="wh-product-name" title="{{ $table->product_nama }}">
                                                    {{ $table->product_nama }}
                                                </h6>
                                                <div class="wh-detail-grid">
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">SKU</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_sku) }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Barcode</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_barcode ?? '-') }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Category</span>
                                                        <span class="wh-detail-value">{{ $table->product_id_category ?? '-' }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Unit</span>
                                                        <span class="wh-detail-value">{{ $table->product_satuan ?? '-' }}</span>
                                                    </div>
                                                </div>
                                                <p class="wh-description">
                                                    {{ \Illuminate\Support\Str::limit($table->product_description ?? '', 80) }}
                                                </p>
                                                <div class="wh-card-footer">
                                                    <div class="wh-price">
                                                        <small class="text-muted">Price</small>
                                                        <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                                    </div>
                                                    <div class="wh-stock-indicator">
                                                        <i class="bi bi-pallet"></i>
                                                        <span>In Stock</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center" style="padding:60px 0; color:#6c757d;">
                                        <i class="bi bi-box-seam" style="font-size:4rem; opacity:0.3;"></i>
                                        <p class="mt-3">No items in this category</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 3 -->
                        <div class="tab-pane" id="tab-cat3" role="tabpanel">
                            <div class="row">
                                @forelse($data->skip(16)->take(8) as $table)
                                    @php $tagColors = ['primary','success','warning','info','danger','secondary']; @endphp
                                    @php $tagColor = $tagColors[array_rand($tagColors)]; @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 wh-col-item">
                                        <div class="wh-card">
                                            <div class="wh-card-header">
                                                <span class="wh-id">#{{ $table->product_id }}</span>
                                                <span class="wh-tag badge bg-{{ $tagColor }}">{{ $table->product_tag ?? 'General' }}</span>
                                            </div>
                                            <div class="wh-card-image">
                                                <img src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="wh-card-actions">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-light" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-danger btn-delete" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="wh-card-body">
                                                <h6 class="wh-product-name" title="{{ $table->product_nama }}">
                                                    {{ $table->product_nama }}
                                                </h6>
                                                <div class="wh-detail-grid">
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">SKU</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_sku) }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Barcode</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_barcode ?? '-') }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Category</span>
                                                        <span class="wh-detail-value">{{ $table->product_id_category ?? '-' }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Unit</span>
                                                        <span class="wh-detail-value">{{ $table->product_satuan ?? '-' }}</span>
                                                    </div>
                                                </div>
                                                <p class="wh-description">
                                                    {{ \Illuminate\Support\Str::limit($table->product_description ?? '', 80) }}
                                                </p>
                                                <div class="wh-card-footer">
                                                    <div class="wh-price">
                                                        <small class="text-muted">Price</small>
                                                        <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                                    </div>
                                                    <div class="wh-stock-indicator">
                                                        <i class="bi bi-pallet"></i>
                                                        <span>In Stock</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center" style="padding:60px 0; color:#6c757d;">
                                        <i class="bi bi-box-seam" style="font-size:4rem; opacity:0.3;"></i>
                                        <p class="mt-3">No items in this category</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 4 -->
                        <div class="tab-pane" id="tab-cat4" role="tabpanel">
                            <div class="row">
                                @forelse($data->skip(24)->take(8) as $table)
                                    @php $tagColors = ['primary','success','warning','info','danger','secondary']; @endphp
                                    @php $tagColor = $tagColors[array_rand($tagColors)]; @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 wh-col-item">
                                        <div class="wh-card">
                                            <div class="wh-card-header">
                                                <span class="wh-id">#{{ $table->product_id }}</span>
                                                <span class="wh-tag badge bg-{{ $tagColor }}">{{ $table->product_tag ?? 'General' }}</span>
                                            </div>
                                            <div class="wh-card-image">
                                                <img src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="wh-card-actions">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-light" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-danger btn-delete" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="wh-card-body">
                                                <h6 class="wh-product-name" title="{{ $table->product_nama }}">
                                                    {{ $table->product_nama }}
                                                </h6>
                                                <div class="wh-detail-grid">
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">SKU</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_sku) }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Barcode</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_barcode ?? '-') }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Category</span>
                                                        <span class="wh-detail-value">{{ $table->product_id_category ?? '-' }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Unit</span>
                                                        <span class="wh-detail-value">{{ $table->product_satuan ?? '-' }}</span>
                                                    </div>
                                                </div>
                                                <p class="wh-description">
                                                    {{ \Illuminate\Support\Str::limit($table->product_description ?? '', 80) }}
                                                </p>
                                                <div class="wh-card-footer">
                                                    <div class="wh-price">
                                                        <small class="text-muted">Price</small>
                                                        <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                                    </div>
                                                    <div class="wh-stock-indicator">
                                                        <i class="bi bi-pallet"></i>
                                                        <span>In Stock</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center" style="padding:60px 0; color:#6c757d;">
                                        <i class="bi bi-box-seam" style="font-size:4rem; opacity:0.3;"></i>
                                        <p class="mt-3">No items in this category</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 5 -->
                        <div class="tab-pane" id="tab-cat5" role="tabpanel">
                            <div class="row">
                                @forelse($data->skip(32)->take(8) as $table)
                                    @php $tagColors = ['primary','success','warning','info','danger','secondary']; @endphp
                                    @php $tagColor = $tagColors[array_rand($tagColors)]; @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 wh-col-item">
                                        <div class="wh-card">
                                            <div class="wh-card-header">
                                                <span class="wh-id">#{{ $table->product_id }}</span>
                                                <span class="wh-tag badge bg-{{ $tagColor }}">{{ $table->product_tag ?? 'General' }}</span>
                                            </div>
                                            <div class="wh-card-image">
                                                <img src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="wh-card-actions">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-light" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-outline-danger btn-delete" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="wh-card-body">
                                                <h6 class="wh-product-name" title="{{ $table->product_nama }}">
                                                    {{ $table->product_nama }}
                                                </h6>
                                                <div class="wh-detail-grid">
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">SKU</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_sku) }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Barcode</span>
                                                        <span class="wh-detail-value wh-mono">{{ strtoupper($table->product_barcode ?? '-') }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Category</span>
                                                        <span class="wh-detail-value">{{ $table->product_id_category ?? '-' }}</span>
                                                    </div>
                                                    <div class="wh-detail-item">
                                                        <span class="wh-detail-label">Unit</span>
                                                        <span class="wh-detail-value">{{ $table->product_satuan ?? '-' }}</span>
                                                    </div>
                                                </div>
                                                <p class="wh-description">
                                                    {{ \Illuminate\Support\Str::limit($table->product_description ?? '', 80) }}
                                                </p>
                                                <div class="wh-card-footer">
                                                    <div class="wh-price">
                                                        <small class="text-muted">Price</small>
                                                        <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                                    </div>
                                                    <div class="wh-stock-indicator">
                                                        <i class="bi bi-pallet"></i>
                                                        <span>In Stock</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center" style="padding:60px 0; color:#6c757d;">
                                        <i class="bi bi-box-seam" style="font-size:4rem; opacity:0.3;"></i>
                                        <p class="mt-3">No items in this category</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>

                </div>

            </x-form>

        </div>

    </x-card>

    <script>
        function switchTab(btn, tabId) {
            event.preventDefault();
            event.stopPropagation();

            document.querySelectorAll('#whFilterTabs .wh-tab').forEach(function(b) {
                b.classList.remove('active');
            });

            document.querySelectorAll('#categoryTabContent .tab-pane').forEach(function(pane) {
                pane.classList.remove('show', 'active');
                pane.style.display = 'none';
            });

            btn.classList.add('active');

            var target = document.getElementById(tabId);
            if (target) {
                target.classList.add('show', 'active');
                target.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#categoryTabContent .tab-pane').forEach(function(pane, index) {
                pane.style.display = (index === 0) ? 'block' : 'none';
            });
        });
    </script>

    <style>
        /* ===== INDUSTRIAL / WAREHOUSE THEME ===== */

        /* Filter Tabs */
        .wh-filter-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 10px 0 14px 0;
            margin-bottom: 16px;
            border-bottom: 2px solid #343a40;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .wh-filter-tabs::-webkit-scrollbar { display: none; }

        .wh-tab {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #adb5bd;
            background-color: #212529;
            border: 1px solid #495057;
            border-bottom: 2px solid transparent;
            border-radius: 4px 4px 0 0;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .wh-tab:hover {
            color: #e9ecef;
            background-color: #2b3035;
            border-color: #6c757d;
        }
        .wh-tab.active {
            color: #f8f9fa;
            background-color: #343a40;
        }
        .wh-tab i { font-size: 0.85rem; }

        @media (max-width: 576px) {
            .wh-filter-tabs { flex-wrap: nowrap; gap: 4px; }
            .wh-tab { padding: 6px 10px; font-size: 0.7rem; }
        }

        /* Card Container */
        .wh-col-item {
            margin-bottom: 16px;
        }

        /* Card */
        .wh-card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            overflow: hidden;
            transition: all 0.25s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .wh-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        /* Card Header */
        .wh-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        .wh-id {
            font-size: 0.7rem;
            font-weight: 700;
            color: #6c757d;
            font-family: 'Courier New', monospace;
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 3px;
        }
        .wh-tag {
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Card Image */
        .wh-card-image {
            position: relative;
            width: 100%;
            padding-top: 65%;
            overflow: hidden;
            background-color: #e9ecef;
            background-image: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(0,0,0,0.02) 10px,
                rgba(0,0,0,0.02) 20px
            );
        }
        .wh-card-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
            opacity: 0.9;
        }
        .wh-card:hover .wh-card-image img {
            transform: scale(1.03);
            opacity: 1;
        }

        .wh-card-actions {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 80px;
            background: linear-gradient(to right, transparent, rgba(0,0,0,0.5));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .wh-card:hover .wh-card-actions {
            opacity: 1;
        }

        /* Card Body */
        .wh-card-body {
            padding: 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .wh-product-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: #212529;
            margin: 0 0 10px 0;
            padding-bottom: 8px;
            border-bottom: 1px dashed #dee2e6;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Detail Grid */
        .wh-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 12px;
            margin-bottom: 10px;
        }
        .wh-detail-item {
            display: flex;
            flex-direction: column;
        }
        .wh-detail-label {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #adb5bd;
            margin-bottom: 1px;
        }
        .wh-detail-value {
            font-size: 0.75rem;
            color: #495057;
            font-weight: 500;
        }
        .wh-mono {
            font-family: 'Courier New', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.3px;
        }

        /* Description */
        .wh-description {
            font-size: 0.72rem;
            color: #868e96;
            line-height: 1.5;
            margin: 0 0 10px 0;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-style: italic;
        }

        /* Card Footer */
        .wh-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 2px solid #e9ecef;
        }
        .wh-price {
            display: flex;
            flex-direction: column;
        }
        .wh-price small {
            font-size: 0.6rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .wh-price strong {
            font-size: 0.95rem;
            color: #d63384;
        }
        .wh-stock-indicator {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.68rem;
            color: #198754;
            font-weight: 600;
        }
        .wh-stock-indicator i {
            font-size: 0.9rem;
        }

        /* Mobile Responsive */
        @media (max-width: 576px) {
            .wh-card-image {
                padding-top: 75%;
            }
            .wh-detail-grid {
                grid-template-columns: 1fr;
                gap: 4px;
            }
            .wh-card-body {
                padding: 10px;
            }
        }
    </style>

</x-layout>
