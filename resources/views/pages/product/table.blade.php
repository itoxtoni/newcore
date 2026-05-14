<x-layout>

    <x-card class="table-container">

        <div class="col-md-12" style="width:100%">

            <x-form method="GET" x-init="" x-target="table" role="search" aria-label="Products"
                autocomplete="off" action="{{ moduleRoute('getTable') }}">
                <x-filter toggle="Filter" :fields="$fields" />
            </x-form>

            <!-- Category Tab Filter -->
            <div class="whm-filter-tabs" id="whmFilterTabs">
                <button class="whm-tab active" onclick="whmSwitchTab(this, 'tab-all')" type="button">
                    <i class="bi bi-grid-3x3-gap-fill"></i> All Items
                </button>
                <button class="whm-tab" onclick="whmSwitchTab(this, 'tab-cat1')" type="button">
                    <i class="bi bi-box-seam"></i> Category 1
                </button>
                <button class="whm-tab" onclick="whmSwitchTab(this, 'tab-cat2')" type="button">
                    <i class="bi bi-archive"></i> Category 2
                </button>
                <button class="whm-tab" onclick="whmSwitchTab(this, 'tab-cat3')" type="button">
                    <i class="bi bi-inbox"></i> Category 3
                </button>
                <button class="whm-tab" onclick="whmSwitchTab(this, 'tab-cat4')" type="button">
                    <i class="bi bi-truck"></i> Category 4
                </button>
                <button class="whm-tab" onclick="whmSwitchTab(this, 'tab-cat5')" type="button">
                    <i class="bi bi-gear"></i> Category 5
                </button>
            </div>

            <x-form method="POST" action="{{ moduleRoute('getTable') }}">

                <x-action />

                <div id="table">

                    <div class="tab-content" id="whmTabContent">

                        <!-- All Items -->
                        <div class="tab-pane show active" id="tab-all" role="tabpanel">
                            <div class="whm-card-grid">
                                @forelse($data as $table)
                                    @php $c = [['bg'=>'#dbeafe','fg'=>'#1e40af'],['bg'=>'#dcfce7','fg'=>'#166534'],['bg'=>'#f3e8ff','fg'=>'#6b21a8'],['bg'=>'#fef3c7','fg'=>'#92400e']][array_rand([0,1,2,3])]; @endphp
                                    <div class="whm-card">
                                        <!-- Header -->
                                        <div class="whm-card-header">
                                            <div class="whm-card-info">
                                                <span class="whm-badge" style="background:{{ $c['bg'] }}; color:{{ $c['fg'] }};">
                                                    {{ $table->product_tag ?? 'General' }}
                                                </span>
                                                <h6 class="whm-card-title">{{ $table->product_nama }}</h6>
                                                <span class="whm-card-sku">
                                                    PRD-{{ str_pad($table->product_id,4,'0',STR_PAD_LEFT) }} &bull; {{ strtoupper($table->product_sku) }}
                                                </span>
                                            </div>
                                            <div class="whm-barcode-box">
                                                <i class="bi bi-upc-scan"></i>
                                                <span>{{ strtoupper($table->product_barcode ?? str_pad($table->product_id,6,'0',STR_PAD_LEFT)) }}</span>
                                            </div>
                                        </div>
                                        <!-- Description -->
                                        <div class="whm-card-desc">
                                            <p>{{ \Illuminate\Support\Str::limit($table->product_description ?? 'No description available', 100) }}</p>
                                        </div>
                                        <!-- Price / Unit -->
                                        <div class="whm-card-pricing">
                                            <div class="whm-price-item">
                                                <small>Price per Unit</small>
                                                <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="whm-price-item whm-price-right">
                                                <small>Unit</small>
                                                <strong>{{ strtoupper($table->product_satuan ?? 'PCS') }}</strong>
                                            </div>
                                        </div>
                                        <!-- Tags -->
                                        <div class="whm-card-tags">
                                            <span class="whm-tag">#In-Stock</span>
                                            <span class="whm-tag">#{{ $table->product_tag ?? 'General' }}</span>
                                        </div>
                                        <!-- Actions -->
                                        <div class="whm-card-actions">
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <a href="{{ moduleRoute('getPrint') }}" class="whm-btn whm-btn-success">
                                                <i class="bi bi-printer"></i> Print
                                            </a>
                                            <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}" class="whm-btn whm-btn-danger btn-delete">
                                                <i class="bi bi-trash3"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="whm-empty">
                                        <i class="bi bi-box-seam"></i>
                                        <p>No inventory items found</p>
                                        <span>Add products to your warehouse inventory</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 1 -->
                        <div class="tab-pane" id="tab-cat1" role="tabpanel">
                            <div class="whm-card-grid">
                                @forelse($data->take(8) as $table)
                                    @php $c = [['bg'=>'#dbeafe','fg'=>'#1e40af'],['bg'=>'#dcfce7','fg'=>'#166534'],['bg'=>'#f3e8ff','fg'=>'#6b21a8'],['bg'=>'#fef3c7','fg'=>'#92400e']][array_rand([0,1,2,3])]; @endphp
                                    <div class="whm-card">
                                        <div class="whm-card-header">
                                            <div class="whm-card-info">
                                                <span class="whm-badge" style="background:{{ $c['bg'] }}; color:{{ $c['fg'] }};">{{ $table->product_tag ?? 'General' }}</span>
                                                <h6 class="whm-card-title">{{ $table->product_nama }}</h6>
                                                <span class="whm-card-sku">PRD-{{ str_pad($table->product_id,4,'0',STR_PAD_LEFT) }} &bull; {{ strtoupper($table->product_sku) }}</span>
                                            </div>
                                            <div class="whm-barcode-box">
                                                <i class="bi bi-upc-scan"></i>
                                                <span>{{ strtoupper($table->product_barcode ?? str_pad($table->product_id,6,'0',STR_PAD_LEFT)) }}</span>
                                            </div>
                                        </div>
                                        <div class="whm-card-desc">
                                            <p>{{ \Illuminate\Support\Str::limit($table->product_description ?? 'No description available', 100) }}</p>
                                        </div>
                                        <div class="whm-card-pricing">
                                            <div class="whm-price-item">
                                                <small>Price per Unit</small>
                                                <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="whm-price-item whm-price-right">
                                                <small>Unit</small>
                                                <strong>{{ strtoupper($table->product_satuan ?? 'PCS') }}</strong>
                                            </div>
                                        </div>
                                        <div class="whm-card-tags">
                                            <span class="whm-tag">#In-Stock</span>
                                            <span class="whm-tag">#{{ $table->product_tag ?? 'General' }}</span>
                                        </div>
                                        <div class="whm-card-actions">
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-eye"></i> View</a>
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-pencil"></i> Edit</a>
                                            <a href="{{ moduleRoute('getPrint') }}" class="whm-btn whm-btn-success"><i class="bi bi-printer"></i> Print</a>
                                            <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}" class="whm-btn whm-btn-danger btn-delete"><i class="bi bi-trash3"></i> Delete</a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="whm-empty"><p>No items in this category</p></div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 2 -->
                        <div class="tab-pane" id="tab-cat2" role="tabpanel">
                            <div class="whm-card-grid">
                                @forelse($data->skip(8)->take(8) as $table)
                                    @php $c = [['bg'=>'#dbeafe','fg'=>'#1e40af'],['bg'=>'#dcfce7','fg'=>'#166534'],['bg'=>'#f3e8ff','fg'=>'#6b21a8'],['bg'=>'#fef3c7','fg'=>'#92400e']][array_rand([0,1,2,3])]; @endphp
                                    <div class="whm-card">
                                        <div class="whm-card-header">
                                            <div class="whm-card-info">
                                                <span class="whm-badge" style="background:{{ $c['bg'] }}; color:{{ $c['fg'] }};">{{ $table->product_tag ?? 'General' }}</span>
                                                <h6 class="whm-card-title">{{ $table->product_nama }}</h6>
                                                <span class="whm-card-sku">PRD-{{ str_pad($table->product_id,4,'0',STR_PAD_LEFT) }} &bull; {{ strtoupper($table->product_sku) }}</span>
                                            </div>
                                            <div class="whm-barcode-box">
                                                <i class="bi bi-upc-scan"></i>
                                                <span>{{ strtoupper($table->product_barcode ?? str_pad($table->product_id,6,'0',STR_PAD_LEFT)) }}</span>
                                            </div>
                                        </div>
                                        <div class="whm-card-desc">
                                            <p>{{ \Illuminate\Support\Str::limit($table->product_description ?? 'No description available', 100) }}</p>
                                        </div>
                                        <div class="whm-card-pricing">
                                            <div class="whm-price-item">
                                                <small>Price per Unit</small>
                                                <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="whm-price-item whm-price-right">
                                                <small>Unit</small>
                                                <strong>{{ strtoupper($table->product_satuan ?? 'PCS') }}</strong>
                                            </div>
                                        </div>
                                        <div class="whm-card-tags">
                                            <span class="whm-tag">#In-Stock</span>
                                            <span class="whm-tag">#{{ $table->product_tag ?? 'General' }}</span>
                                        </div>
                                        <div class="whm-card-actions">
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-eye"></i> View</a>
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-pencil"></i> Edit</a>
                                            <a href="{{ moduleRoute('getPrint') }}" class="whm-btn whm-btn-success"><i class="bi bi-printer"></i> Print</a>
                                            <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}" class="whm-btn whm-btn-danger btn-delete"><i class="bi bi-trash3"></i> Delete</a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="whm-empty"><p>No items in this category</p></div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 3 -->
                        <div class="tab-pane" id="tab-cat3" role="tabpanel">
                            <div class="whm-card-grid">
                                @forelse($data->skip(16)->take(8) as $table)
                                    @php $c = [['bg'=>'#dbeafe','fg'=>'#1e40af'],['bg'=>'#dcfce7','fg'=>'#166534'],['bg'=>'#f3e8ff','fg'=>'#6b21a8'],['bg'=>'#fef3c7','fg'=>'#92400e']][array_rand([0,1,2,3])]; @endphp
                                    <div class="whm-card">
                                        <div class="whm-card-header">
                                            <div class="whm-card-info">
                                                <span class="whm-badge" style="background:{{ $c['bg'] }}; color:{{ $c['fg'] }};">{{ $table->product_tag ?? 'General' }}</span>
                                                <h6 class="whm-card-title">{{ $table->product_nama }}</h6>
                                                <span class="whm-card-sku">PRD-{{ str_pad($table->product_id,4,'0',STR_PAD_LEFT) }} &bull; {{ strtoupper($table->product_sku) }}</span>
                                            </div>
                                            <div class="whm-barcode-box">
                                                <i class="bi bi-upc-scan"></i>
                                                <span>{{ strtoupper($table->product_barcode ?? str_pad($table->product_id,6,'0',STR_PAD_LEFT)) }}</span>
                                            </div>
                                        </div>
                                        <div class="whm-card-desc">
                                            <p>{{ \Illuminate\Support\Str::limit($table->product_description ?? 'No description available', 100) }}</p>
                                        </div>
                                        <div class="whm-card-pricing">
                                            <div class="whm-price-item">
                                                <small>Price per Unit</small>
                                                <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="whm-price-item whm-price-right">
                                                <small>Unit</small>
                                                <strong>{{ strtoupper($table->product_satuan ?? 'PCS') }}</strong>
                                            </div>
                                        </div>
                                        <div class="whm-card-tags">
                                            <span class="whm-tag">#In-Stock</span>
                                            <span class="whm-tag">#{{ $table->product_tag ?? 'General' }}</span>
                                        </div>
                                        <div class="whm-card-actions">
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-eye"></i> View</a>
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-pencil"></i> Edit</a>
                                            <a href="{{ moduleRoute('getPrint') }}" class="whm-btn whm-btn-success"><i class="bi bi-printer"></i> Print</a>
                                            <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}" class="whm-btn whm-btn-danger btn-delete"><i class="bi bi-trash3"></i> Delete</a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="whm-empty"><p>No items in this category</p></div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 4 -->
                        <div class="tab-pane" id="tab-cat4" role="tabpanel">
                            <div class="whm-card-grid">
                                @forelse($data->skip(24)->take(8) as $table)
                                    @php $c = [['bg'=>'#dbeafe','fg'=>'#1e40af'],['bg'=>'#dcfce7','fg'=>'#166534'],['bg'=>'#f3e8ff','fg'=>'#6b21a8'],['bg'=>'#fef3c7','fg'=>'#92400e']][array_rand([0,1,2,3])]; @endphp
                                    <div class="whm-card">
                                        <div class="whm-card-header">
                                            <div class="whm-card-info">
                                                <span class="whm-badge" style="background:{{ $c['bg'] }}; color:{{ $c['fg'] }};">{{ $table->product_tag ?? 'General' }}</span>
                                                <h6 class="whm-card-title">{{ $table->product_nama }}</h6>
                                                <span class="whm-card-sku">PRD-{{ str_pad($table->product_id,4,'0',STR_PAD_LEFT) }} &bull; {{ strtoupper($table->product_sku) }}</span>
                                            </div>
                                            <div class="whm-barcode-box">
                                                <i class="bi bi-upc-scan"></i>
                                                <span>{{ strtoupper($table->product_barcode ?? str_pad($table->product_id,6,'0',STR_PAD_LEFT)) }}</span>
                                            </div>
                                        </div>
                                        <div class="whm-card-desc">
                                            <p>{{ \Illuminate\Support\Str::limit($table->product_description ?? 'No description available', 100) }}</p>
                                        </div>
                                        <div class="whm-card-pricing">
                                            <div class="whm-price-item">
                                                <small>Price per Unit</small>
                                                <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="whm-price-item whm-price-right">
                                                <small>Unit</small>
                                                <strong>{{ strtoupper($table->product_satuan ?? 'PCS') }}</strong>
                                            </div>
                                        </div>
                                        <div class="whm-card-tags">
                                            <span class="whm-tag">#In-Stock</span>
                                            <span class="whm-tag">#{{ $table->product_tag ?? 'General' }}</span>
                                        </div>
                                        <div class="whm-card-actions">
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-eye"></i> View</a>
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-pencil"></i> Edit</a>
                                            <a href="{{ moduleRoute('getPrint') }}" class="whm-btn whm-btn-success"><i class="bi bi-printer"></i> Print</a>
                                            <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}" class="whm-btn whm-btn-danger btn-delete"><i class="bi bi-trash3"></i> Delete</a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="whm-empty"><p>No items in this category</p></div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category 5 -->
                        <div class="tab-pane" id="tab-cat5" role="tabpanel">
                            <div class="whm-card-grid">
                                @forelse($data->skip(32)->take(8) as $table)
                                    @php $c = [['bg'=>'#dbeafe','fg'=>'#1e40af'],['bg'=>'#dcfce7','fg'=>'#166534'],['bg'=>'#f3e8ff','fg'=>'#6b21a8'],['bg'=>'#fef3c7','fg'=>'#92400e']][array_rand([0,1,2,3])]; @endphp
                                    <div class="whm-card">
                                        <div class="whm-card-header">
                                            <div class="whm-card-info">
                                                <span class="whm-badge" style="background:{{ $c['bg'] }}; color:{{ $c['fg'] }};">{{ $table->product_tag ?? 'General' }}</span>
                                                <h6 class="whm-card-title">{{ $table->product_nama }}</h6>
                                                <span class="whm-card-sku">PRD-{{ str_pad($table->product_id,4,'0',STR_PAD_LEFT) }} &bull; {{ strtoupper($table->product_sku) }}</span>
                                            </div>
                                            <div class="whm-barcode-box">
                                                <i class="bi bi-upc-scan"></i>
                                                <span>{{ strtoupper($table->product_barcode ?? str_pad($table->product_id,6,'0',STR_PAD_LEFT)) }}</span>
                                            </div>
                                        </div>
                                        <div class="whm-card-desc">
                                            <p>{{ \Illuminate\Support\Str::limit($table->product_description ?? 'No description available', 100) }}</p>
                                        </div>
                                        <div class="whm-card-pricing">
                                            <div class="whm-price-item">
                                                <small>Price per Unit</small>
                                                <strong>Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="whm-price-item whm-price-right">
                                                <small>Unit</small>
                                                <strong>{{ strtoupper($table->product_satuan ?? 'PCS') }}</strong>
                                            </div>
                                        </div>
                                        <div class="whm-card-tags">
                                            <span class="whm-tag">#In-Stock</span>
                                            <span class="whm-tag">#{{ $table->product_tag ?? 'General' }}</span>
                                        </div>
                                        <div class="whm-card-actions">
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-eye"></i> View</a>
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-btn whm-btn-primary"><i class="bi bi-pencil"></i> Edit</a>
                                            <a href="{{ moduleRoute('getPrint') }}" class="whm-btn whm-btn-success"><i class="bi bi-printer"></i> Print</a>
                                            <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}" class="whm-btn whm-btn-danger btn-delete"><i class="bi bi-trash3"></i> Delete</a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="whm-empty"><p>No items in this category</p></div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>

            </x-form>

        </div>

    </x-card>

    <script>
        function whmSwitchTab(btn, tabId) {
            event.preventDefault();
            event.stopPropagation();
            document.querySelectorAll('#whmFilterTabs .whm-tab').forEach(function(b) { b.classList.remove('active'); });
            document.querySelectorAll('#whmTabContent .tab-pane').forEach(function(p) {
                p.classList.remove('show', 'active');
                p.style.display = 'none';
            });
            btn.classList.add('active');
            var target = document.getElementById(tabId);
            if (target) {
                target.classList.add('show', 'active');
                target.style.display = 'block';
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#whmTabContent .tab-pane').forEach(function(p, i) {
                p.style.display = (i === 0) ? 'block' : 'none';
            });
        });
    </script>

    <style>
        /* ========================================
           WHM Product Cards - Scoped Styles
           ======================================== */

        /* Filter Tabs */
        .whm-filter-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 10px 0 14px;
            margin-bottom: 16px;
            border-bottom: 2px solid #343a40;
        }

        .whm-tab {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
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

        .whm-tab:hover {
            color: #e9ecef;
            background-color: #2b3035;
        }

        .whm-tab.active {
            color: #f8f9fa;
            background-color: #343a40;
        }

        .whm-tab i {
            font-size: 0.85rem;
        }

        /* Card Grid */
        .whm-card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        @media (max-width: 1200px) {
            .whm-card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .whm-card-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
        }

        @media (max-width: 544px) {
            .whm-card-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .whm-filter-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
                scrollbar-width: none;
                -webkit-overflow-scrolling: touch;
            }

            .whm-filter-tabs::-webkit-scrollbar {
                display: none;
            }
        }

        /* Card */
        .whm-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Card Header */
        .whm-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 12px;
            gap: 10px;
        }

        .whm-card-info {
            flex: 1;
            min-width: 0;
        }

        .whm-badge {
            display: inline-block;
            padding: 1px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 6px;
        }

        .whm-card-title {
            font-size: 14px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 4px 0;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-wrap: break-word;
        }

        .whm-card-sku {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 500;
            font-family: monospace;
        }

        /* Barcode Box */
        .whm-barcode-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 6px 8px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: #fafafa;
            flex-shrink: 0;
            width: 64px;
        }

        .whm-barcode-box i {
            font-size: 20px;
            color: #374151;
        }

        .whm-barcode-box span {
            font-size: 9px;
            letter-spacing: 0.06em;
            font-weight: 700;
            color: #666;
            margin-top: 2px;
            font-family: 'Courier New', monospace;
            text-align: center;
            word-break: break-all;
        }

        /* Description */
        .whm-card-desc {
            padding: 0 12px;
            margin-top: 8px;
        }

        .whm-card-desc p {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.5;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-wrap: break-word;
        }

        /* Pricing */
        .whm-card-pricing {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-top: 1px solid #f0f0f0;
            margin: 10px 12px 0 12px;
            padding-top: 10px;
        }

        .whm-price-item {
            display: block;
        }

        .whm-price-item small {
            display: block;
            font-size: 10px;
            color: #adb5bd;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1px;
        }

        .whm-price-item strong {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: #059669;
            line-height: 1.3;
        }

        .whm-price-right {
            text-align: right;
        }

        .whm-price-right strong {
            font-size: 13px;
            color: #212529;
        }

        /* Tags */
        .whm-card-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin: 10px 12px 0 12px;
        }

        .whm-tag {
            display: inline-block;
            padding: 2px 7px;
            background: #f3f4f6;
            color: #6b7280;
            font-size: 10px;
            font-weight: 600;
            border-radius: 4px;
        }

        /* Action Buttons */
        .whm-card-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5px;
            margin: 12px;
        }

        .whm-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            height: 34px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            padding: 0 6px;
            line-height: 1;
            transition: background 0.15s ease, border-color 0.15s ease;
        }

        .whm-btn-primary {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
        }

        .whm-btn-primary:hover {
            background: #dbeafe;
            border-color: #93c5fd;
            color: #1e40af;
        }

        .whm-btn-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
        }

        .whm-btn-success:hover {
            background: #d1fae5;
            border-color: #6ee7b7;
            color: #065f46;
        }

        .whm-btn-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .whm-btn-danger:hover {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #b91c1c;
        }

        .whm-btn i {
            font-size: 13px;
        }

        /* Empty State */
        .whm-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 0;
            color: #aaa;
        }

        .whm-empty i {
            font-size: 64px;
            color: #ddd;
        }

        .whm-empty p {
            font-size: 16px;
            color: #888;
            margin: 12px 0 4px;
        }

        .whm-empty span {
            color: #aaa;
            font-size: 13px;
        }
    </style>

</x-layout>
