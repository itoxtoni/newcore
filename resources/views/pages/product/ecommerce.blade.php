<x-layout>

    <x-card class="table-container">

        <div class="col-md-12" style="width:100%">

            <x-form method="GET" x-init="" x-target="table" role="search" aria-label="Products"
                autocomplete="off" action="{{ moduleRoute('getTable') }}">
                <x-filter toggle="Filter" :fields="$fields" />
            </x-form>

            <!-- Category Tab Filter - OUTSIDE the form to avoid interference -->
            <div class="product-filter-tabs" id="productFilterTabs">
                <button class="filter-badge active" onclick="switchTab(this, 'tab-all')" type="button">
                    <i class="bi bi-grid-3x3-gap-fill"></i> Show All
                </button>
                <button class="filter-badge" onclick="switchTab(this, 'tab-electronics')" type="button">
                    <i class="bi bi-laptop"></i> Electronics
                </button>
                <button class="filter-badge" onclick="switchTab(this, 'tab-fashion')" type="button">
                    <i class="bi bi-handbag"></i> Fashion
                </button>
                <button class="filter-badge" onclick="switchTab(this, 'tab-food')" type="button">
                    <i class="bi bi-cup-hot"></i> Food & Beverage
                </button>
                <button class="filter-badge" onclick="switchTab(this, 'tab-home')" type="button">
                    <i class="bi bi-house-door"></i> Home & Living
                </button>
                <button class="filter-badge" onclick="switchTab(this, 'tab-sports')" type="button">
                    <i class="bi bi-bicycle"></i> Sports
                </button>
            </div>

            <x-form method="POST" action="{{ moduleRoute('getTable') }}">

                <x-action />

                <div id="table">

                    <div class="tab-content" id="categoryTabContent">

                        <!-- All Products -->
                        <div class="tab-pane show active" id="tab-all" role="tabpanel">
                            <div class="row">
                                @forelse($data as $table)
                                    @php $badges = ['Electronics', 'Fashion', 'Food & Beverage', 'Home & Living', 'Sports']; @endphp
                                    @php $badge = $badges[array_rand($badges)]; @endphp
                                    @php $badgeClass = strtolower(str_replace([' ', '&'], '', $badge)); @endphp
                                    <div class="col-lg-4 col-md-6 col-6 product-col-item">
                                        <div class="product-card">
                                            <div class="product-image-wrapper">
                                                <img class="product-image"
                                                    src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="product-badge badge-{{ $badgeClass }}">{{ $badge }}</div>
                                                <div class="product-overlay">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-light" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-danger btn-delete" title="Delete"
                                                        style="margin-left:4px">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-name">{{ \Illuminate\Support\Str::limit($table->product_nama, 30) }}</h6>
                                                <p class="product-sku">SKU: {{ strtoupper($table->product_sku) }}</p>
                                                <p class="product-price">Rp {{ number_format($table->product_harga ?? rand(1000, 10000), 0, ',', '.') }}</p>
                                                <p class="product-desc">{{ \Illuminate\Support\Str::limit($table->product_description ?? '', 60) }}</p>
                                                <div class="product-footer">
                                                    <span class="product-stock"><i class="bi bi-box-seam"></i> {{ $table->product_satuan ?? 'pcs' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted" style="padding:40px 0">
                                        <i class="bi bi-inbox" style="font-size:3rem"></i>
                                        <p>No products found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Electronics -->
                        <div class="tab-pane" id="tab-electronics" role="tabpanel">
                            <div class="row">
                                @forelse($data->take(8) as $table)
                                    <div class="col-lg-4 col-md-6 col-6 product-col-item">
                                        <div class="product-card">
                                            <div class="product-image-wrapper">
                                                <img class="product-image"
                                                    src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="product-badge badge-electronics">Electronics</div>
                                                <div class="product-overlay">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-light" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-danger btn-delete" title="Delete"
                                                        style="margin-left:4px">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-name">{{ \Illuminate\Support\Str::limit($table->product_nama, 30) }}</h6>
                                                <p class="product-sku">SKU: {{ strtoupper($table->product_sku) }}</p>
                                                <p class="product-price">Rp {{ number_format($table->product_harga ?? rand(1000, 10000), 0, ',', '.') }}</p>
                                                <p class="product-desc">{{ \Illuminate\Support\Str::limit($table->product_description ?? '', 60) }}</p>
                                                <div class="product-footer">
                                                    <span class="product-stock"><i class="bi bi-box-seam"></i> {{ $table->product_satuan ?? 'pcs' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted" style="padding:40px 0">
                                        <i class="bi bi-inbox" style="font-size:3rem"></i>
                                        <p>No products found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Fashion -->
                        <div class="tab-pane" id="tab-fashion" role="tabpanel">
                            <div class="row">
                                @forelse($data->skip(8)->take(8) as $table)
                                    <div class="col-lg-4 col-md-6 col-6 product-col-item">
                                        <div class="product-card">
                                            <div class="product-image-wrapper">
                                                <img class="product-image"
                                                    src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="product-badge badge-fashion">Fashion</div>
                                                <div class="product-overlay">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-light" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-danger btn-delete" title="Delete"
                                                        style="margin-left:4px">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-name">{{ \Illuminate\Support\Str::limit($table->product_nama, 30) }}</h6>
                                                <p class="product-sku">SKU: {{ strtoupper($table->product_sku) }}</p>
                                                <p class="product-price">Rp {{ number_format($table->product_harga ?? rand(1000, 10000), 0, ',', '.') }}</p>
                                                <p class="product-desc">{{ \Illuminate\Support\Str::limit($table->product_description ?? '', 60) }}</p>
                                                <div class="product-footer">
                                                    <span class="product-stock"><i class="bi bi-box-seam"></i> {{ $table->product_satuan ?? 'pcs' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted" style="padding:40px 0">
                                        <i class="bi bi-inbox" style="font-size:3rem"></i>
                                        <p>No products found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Food & Beverage -->
                        <div class="tab-pane" id="tab-food" role="tabpanel">
                            <div class="row">
                                @forelse($data->skip(16)->take(8) as $table)
                                    <div class="col-lg-4 col-md-6 col-6 product-col-item">
                                        <div class="product-card">
                                            <div class="product-image-wrapper">
                                                <img class="product-image"
                                                    src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="product-badge badge-foodandbeverage">Food & Beverage</div>
                                                <div class="product-overlay">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-light" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-danger btn-delete" title="Delete"
                                                        style="margin-left:4px">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-name">{{ \Illuminate\Support\Str::limit($table->product_nama, 30) }}</h6>
                                                <p class="product-sku">SKU: {{ strtoupper($table->product_sku) }}</p>
                                                <p class="product-price">Rp {{ number_format($table->product_harga ?? rand(1000, 10000), 0, ',', '.') }}</p>
                                                <p class="product-desc">{{ \Illuminate\Support\Str::limit($table->product_description ?? '', 60) }}</p>
                                                <div class="product-footer">
                                                    <span class="product-stock"><i class="bi bi-box-seam"></i> {{ $table->product_satuan ?? 'pcs' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted" style="padding:40px 0">
                                        <i class="bi bi-inbox" style="font-size:3rem"></i>
                                        <p>No products found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Home & Living -->
                        <div class="tab-pane" id="tab-home" role="tabpanel">
                            <div class="row">
                                @forelse($data->skip(24)->take(8) as $table)
                                    <div class="col-lg-4 col-md-6 col-6 product-col-item">
                                        <div class="product-card">
                                            <div class="product-image-wrapper">
                                                <img class="product-image"
                                                    src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="product-badge badge-homeandliving">Home & Living</div>
                                                <div class="product-overlay">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-light" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-danger btn-delete" title="Delete"
                                                        style="margin-left:4px">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-name">{{ \Illuminate\Support\Str::limit($table->product_nama, 30) }}</h6>
                                                <p class="product-sku">SKU: {{ strtoupper($table->product_sku) }}</p>
                                                <p class="product-price">Rp {{ number_format($table->product_harga ?? rand(1000, 10000), 0, ',', '.') }}</p>
                                                <p class="product-desc">{{ \Illuminate\Support\Str::limit($table->product_description ?? '', 60) }}</p>
                                                <div class="product-footer">
                                                    <span class="product-stock"><i class="bi bi-box-seam"></i> {{ $table->product_satuan ?? 'pcs' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted" style="padding:40px 0">
                                        <i class="bi bi-inbox" style="font-size:3rem"></i>
                                        <p>No products found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Sports -->
                        <div class="tab-pane" id="tab-sports" role="tabpanel">
                            <div class="row">
                                @forelse($data->skip(32)->take(8) as $table)
                                    <div class="col-lg-4 col-md-6 col-6 product-col-item">
                                        <div class="product-card">
                                            <div class="product-image-wrapper">
                                                <img class="product-image"
                                                    src="{{ asset('images/faker/'.$table->product_image.'.jpg') }}"
                                                    alt="{{ $table->product_nama }}">
                                                <div class="product-badge badge-sports">Sports</div>
                                                <div class="product-overlay">
                                                    <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}"
                                                        class="btn btn-sm btn-light" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}"
                                                        class="btn btn-sm btn-danger btn-delete" title="Delete"
                                                        style="margin-left:4px">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-name">{{ \Illuminate\Support\Str::limit($table->product_nama, 30) }}</h6>
                                                <p class="product-sku">SKU: {{ strtoupper($table->product_sku) }}</p>
                                                <p class="product-price">Rp {{ number_format($table->product_harga ?? rand(1000, 10000), 0, ',', '.') }}</p>
                                                <p class="product-desc">{{ \Illuminate\Support\Str::limit($table->product_description ?? '', 60) }}</p>
                                                <div class="product-footer">
                                                    <span class="product-stock"><i class="bi bi-box-seam"></i> {{ $table->product_satuan ?? 'pcs' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted" style="padding:40px 0">
                                        <i class="bi bi-inbox" style="font-size:3rem"></i>
                                        <p>No products found</p>
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
            // Prevent any form submission
            event.preventDefault();
            event.stopPropagation();

            // Deactivate all tabs
            document.querySelectorAll('#productFilterTabs .filter-badge').forEach(function(b) {
                b.classList.remove('active');
            });

            // Hide all tab panes
            document.querySelectorAll('#categoryTabContent .tab-pane').forEach(function(pane) {
                pane.classList.remove('show', 'active');
                pane.style.display = 'none';
            });

            // Activate clicked button
            btn.classList.add('active');

            // Show target tab pane
            var target = document.getElementById(tabId);
            if (target) {
                target.classList.add('show', 'active');
                target.style.display = 'block';
            }
        }

        // Initialize: ensure only first tab is visible on load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#categoryTabContent .tab-pane').forEach(function(pane, index) {
                if (index === 0) {
                    pane.style.display = 'block';
                } else {
                    pane.style.display = 'none';
                }
            });
        });
    </script>

    <style>
        /* Filter Tabs - Badge style, horizontal scroll on mobile */
        .product-filter-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 12px 0 16px 0;
            margin-bottom: 16px;
            border-bottom: 1px solid #e9ecef;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .product-filter-tabs::-webkit-scrollbar {
            display: none;
        }

        .filter-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            font-size: 0.8rem;
            font-weight: 500;
            color: #495057;
            background-color: #f1f3f5;
            border: 1px solid #dee2e6;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .filter-badge:hover {
            color: #0d6efd;
            background-color: #e7f1ff;
            border-color: #b6d4fe;
        }

        .filter-badge.active {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
            font-weight: 600;
        }

        .filter-badge i {
            font-size: 0.85rem;
        }

        /* Mobile: smaller badges */
        @media (max-width: 576px) {
            .product-filter-tabs {
                flex-wrap: nowrap;
                gap: 6px;
                padding-bottom: 12px;
            }

            .filter-badge {
                padding: 6px 12px;
                font-size: 0.72rem;
            }

            .filter-badge i {
                font-size: 0.78rem;
            }
        }

        /* Product Column Padding */
        .product-col-item {
            margin-bottom: 16px;
        }

        /* Product Card */
        .product-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Product Image */
        .product-image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 100%;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        /* Product Badge */
        .product-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            padding: 3px 8px;
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 4px;
            color: #fff;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            z-index: 2;
        }

        .badge-electronics { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .badge-fashion { background: linear-gradient(135deg, #ec4899, #db2777); }
        .badge-foodandbeverage { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .badge-homeandliving { background: linear-gradient(135deg, #10b981, #059669); }
        .badge-sports { background: linear-gradient(135deg, #ef4444, #dc2626); }

        /* Product Overlay */
        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 3;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        /* Product Info */
        .product-info {
            padding: 10px 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #212529;
            margin: 0 0 4px 0;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-sku {
            font-size: 0.68rem;
            color: #9ca3af;
            margin: 0 0 6px 0;
            font-family: monospace;
        }

        .product-price {
            font-size: 0.95rem;
            font-weight: 700;
            color: #dc2626;
            margin: 0 0 6px 0;
        }

        .product-desc {
            font-size: 0.72rem;
            color: #6b7280;
            line-height: 1.4;
            margin: 0 0 8px 0;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 8px;
            border-top: 1px solid #f3f4f6;
        }

        .product-stock {
            font-size: 0.68rem;
            color: #9ca3af;
        }
    </style>

</x-layout>
