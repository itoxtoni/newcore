<x-layout>

    @push('footer')
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @endpush

    <div id="whmRoot">

        <!-- Page Title -->
        <div style="margin-bottom:16px;">
            <h4 style="margin:0; font-weight:700; font-size:20px; color:#00193c; font-family:'Inter',sans-serif;">
                <span class="material-symbols-outlined" style="font-size:24px; vertical-align:middle; margin-right:6px;">inventory_2</span>
                Product Inventory
            </h4>
            <p style="margin:4px 0 0 0; font-size:13px; color:#888; font-family:'Inter',sans-serif;">
                Manage your warehouse products and stock items
            </p>
        </div>

        <x-card class="whm-card-wrapper">

            <div class="col-md-12" style="width:100%">

                <!-- Search Form -->
                <x-form method="GET" x-init="" x-target="whmGrid" role="search" aria-label="Products"
                    autocomplete="off" action="{{ moduleRoute('getTable') }}">
                    <div class="whm-search-box">
                        <span class="material-symbols-outlined" style="font-size:20px; color:#999;">search</span>
                        <input type="text" name="search" placeholder="Search by product name, SKU, or ID..." class="whm-search-input" />
                    </div>
                    <x-filter toggle="Filter" :fields="$fields" />
                </x-form>

                <!-- Filter Pills -->
                <div class="whm-pills">
                    <button class="whm-pills__btn whm-pills__btn--active" onclick="whmSwitch(this,'all')" type="button">
                        <span class="material-symbols-outlined">apps</span> All Items
                    </button>
                    <button class="whm-pills__btn" onclick="whmSwitch(this,'cat1')" type="button">
                        <span class="material-symbols-outlined">category</span> Category 1
                    </button>
                    <button class="whm-pills__btn" onclick="whmSwitch(this,'cat2')" type="button">
                        <span class="material-symbols-outlined">inventory_2</span> Category 2
                    </button>
                    <button class="whm-pills__btn" onclick="whmSwitch(this,'cat3')" type="button">
                        <span class="material-symbols-outlined">warehouse</span> Category 3
                    </button>
                    <button class="whm-pills__btn" onclick="whmSwitch(this,'cat4')" type="button">
                        <span class="material-symbols-outlined">local_shipping</span> Category 4
                    </button>
                    <button class="whm-pills__btn" onclick="whmSwitch(this,'cat5')" type="button">
                        <span class="material-symbols-outlined">precision_manufacturing</span> Category 5
                    </button>
                </div>

                <!-- POST Form -->
                <x-form method="POST" action="{{ moduleRoute('getTable') }}">
                    <x-action />

                    <div id="whmGrid">
                        <div class="row">

                            @forelse($data as $table)
                                @php
                                    $colors = [
                                        ['bg'=>'#dbeafe','fg'=>'#1e40af'],
                                        ['bg'=>'#dcfce7','fg'=>'#166534'],
                                        ['bg'=>'#f3e8ff','fg'=>'#6b21a8'],
                                        ['bg'=>'#fef3c7','fg'=>'#92400e'],
                                    ];
                                    $c = $colors[array_rand($colors)];
                                @endphp

                                <div class="col-xl-4 col-lg-6 col-md-6 col-12 whm-grid-item">
                                    <div class="whm-item">

                                        <!-- Row 1: Category + Barcode -->
                                        <div class="whm-item__row1">
                                            <div class="whm-item__info">
                                                <span class="whm-item__cat" style="background:{{ $c['bg'] }}; color:{{ $c['fg'] }};">
                                                    {{ $table->product_tag ?? 'General' }}
                                                </span>
                                                <div class="whm-item__name">{{ $table->product_nama }}</div>
                                                <div class="whm-item__sku">
                                                    PRD-{{ str_pad($table->product_id,4,'0',STR_PAD_LEFT) }} &bull; {{ strtoupper($table->product_sku) }}
                                                </div>
                                            </div>
                                            <div class="whm-item__qr">
                                                <span class="material-symbols-outlined">barcode</span>
                                                <div class="whm-item__qr-text">{{ strtoupper($table->product_barcode ?? str_pad($table->product_id,6,'0',STR_PAD_LEFT)) }}</div>
                                            </div>
                                        </div>

                                        <!-- Row 2: Description -->
                                        <div class="whm-item__desc">
                                            {{ \Illuminate\Support\Str::limit($table->product_description ?? 'No description available', 100) }}
                                        </div>

                                        <!-- Row 3: Price + Unit -->
                                        <div class="whm-item__price-row">
                                            <div class="whm-item__price-box">
                                                <div class="whm-item__label">Price per Unit</div>
                                                <div class="whm-item__price-val">Rp {{ number_format($table->product_harga ?? 0, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="whm-item__unit-box">
                                                <div class="whm-item__label">Unit</div>
                                                <div class="whm-item__unit-val">{{ strtoupper($table->product_satuan ?? 'PCS') }}</div>
                                            </div>
                                        </div>

                                        <!-- Row 4: Tags -->
                                        <div class="whm-item__tags">
                                            <span class="whm-item__tag">#In-Stock</span>
                                            <span class="whm-item__tag">#{{ $table->product_tag ?? 'General' }}</span>
                                        </div>

                                        <!-- Row 5: Buttons -->
                                        <div class="whm-item__btns">
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-item__btn whm-item__btn--view">
                                                <span class="material-symbols-outlined">visibility</span> View
                                            </a>
                                            <a href="{{ moduleRoute('getUpdate', [$table->field_primary]) }}" class="whm-item__btn whm-item__btn--edit">
                                                <span class="material-symbols-outlined">edit</span> Edit
                                            </a>
                                            <a href="" class="whm-item__btn whm-item__btn--print">
                                                <span class="material-symbols-outlined">print</span> Print
                                            </a>
                                            <a href="{{ moduleRoute('getDelete', ['code' => $table->field_primary]) }}" class="whm-item__btn whm-item__btn--del btn-delete">
                                                <span class="material-symbols-outlined">delete</span> Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div style="text-align:center; padding:60px 0; color:#aaa;">
                                        <span class="material-symbols-outlined" style="font-size:64px; color:#ddd;">inventory_2</span>
                                        <p style="font-size:16px; color:#888; margin:12px 0 4px;">No inventory items found</p>
                                        <small style="color:#aaa;">Add products to your warehouse inventory</small>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>

                </x-form>

            </div>
        </x-card>

    </div>

    <script>
        function whmSwitch(btn, cat) {
            document.querySelectorAll('.whm-pills__btn').forEach(function(p) {
                p.classList.remove('whm-pills__btn--active');
            });
            btn.classList.add('whm-pills__btn--active');

            var items = document.querySelectorAll('.whm-grid-item');
            for (var i = 0; i < items.length; i++) {
                if (cat === 'all') {
                    items[i].style.display = '';
                } else {
                    var s = (parseInt(cat.replace('cat', '')) - 1) * 8;
                    var e = s + 8;
                    items[i].style.display = (i >= s && i < e) ? '' : 'none';
                }
            }
        }
    </script>

    <style>
        /* ========== WHM Inventory - Fully Scoped ========== */

        /* Reset the card wrapper */
        #whmRoot .whm-card-wrapper {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            background: transparent !important;
            margin-bottom: 0 !important;
        }
        #whmRoot .whm-card-wrapper .card-body {
            padding: 0 !important;
        }

        /* Material Symbols scope */
        #whmRoot .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }

        /* Search */
        .whm-search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            height: 42px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 12px;
            background: #fff;
        }
        .whm-search-input {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            flex: 1;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            padding: 0;
            background: transparent !important;
            height: auto !important;
        }

        /* Filter Pills */
        .whm-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 10px 0 14px;
            margin-bottom: 16px;
            border-bottom: 1px solid #e9ecef;
        }
        .whm-pills__btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            color: #555;
            background: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 16px;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.15s, color 0.15s;
            line-height: 1.4;
        }
        .whm-pills__btn .material-symbols-outlined {
            font-size: 14px !important;
        }
        .whm-pills__btn:hover {
            background: #eee;
        }
        .whm-pills__btn--active {
            background: #d1fae5 !important;
            color: #065f46 !important;
            border-color: #34d399 !important;
            font-weight: 600;
        }

        /* Grid */
        .whm-grid-item {
            margin-bottom: 16px;
        }

        /* Card */
        .whm-item {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #fff;
            padding: 14px;
            transition: box-shadow 0.2s;
        }
        .whm-item:hover {
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        /* Row 1: Info + Barcode */
        .whm-item__row1 {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .whm-item__info {
            display: table-cell;
            vertical-align: top;
            width: 70%;
            padding-right: 10px;
        }
        .whm-item__qr {
            display: table-cell;
            vertical-align: top;
            width: 70px;
            text-align: center;
            padding: 6px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: #fafafa;
        }
        .whm-item__qr .material-symbols-outlined {
            font-size: 26px !important;
            color: #374151;
        }
        .whm-item__qr-text {
            font-size: 9px;
            letter-spacing: 0.08em;
            font-weight: 700;
            color: #666;
            margin-top: 2px;
            font-family: 'Courier New', monospace;
        }

        /* Category Badge */
        .whm-item__cat {
            display: inline-block;
            padding: 1px 7px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            margin-bottom: 4px;
            line-height: 1.5;
        }

        /* Name */
        .whm-item__name {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a2e;
            line-height: 1.3;
            margin-bottom: 2px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

        /* SKU */
        .whm-item__sku {
            font-size: 11px;
            color: #999;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
        }

        /* Description */
        .whm-item__desc {
            font-size: 12px;
            color: #777;
            line-height: 1.5;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            clear: both;
        }

        /* Price Row */
        .whm-item__price-row {
            display: table;
            width: 100%;
            border-top: 1px solid #f0f0f0;
            padding-top: 10px;
            margin-bottom: 10px;
        }
        .whm-item__price-box {
            display: table-cell;
            vertical-align: bottom;
        }
        .whm-item__unit-box {
            display: table-cell;
            vertical-align: bottom;
            text-align: right;
        }
        .whm-item__label {
            font-size: 10px;
            color: #aaa;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 1px;
            font-family: 'Inter', sans-serif;
        }
        .whm-item__price-val {
            font-size: 15px;
            font-weight: 700;
            color: #059669;
            font-family: 'Inter', sans-serif;
        }
        .whm-item__unit-val {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
            font-family: 'Inter', sans-serif;
        }

        /* Tags */
        .whm-item__tags {
            margin-bottom: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }
        .whm-item__tag {
            display: inline-block;
            padding: 2px 7px;
            background: #f3f4f6;
            color: #6b7280;
            font-size: 10px;
            font-weight: 500;
            border-radius: 4px;
            font-family: 'Inter', sans-serif;
        }

        /* Buttons */
        .whm-item__btns {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        .whm-item__btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 3px;
            flex: 1;
            min-width: 70px;
            height: 32px;
            font-size: 11px !important;
            font-weight: 600;
            font-family: 'Inter', sans-serif !important;
            border-radius: 6px;
            text-decoration: none !important;
            padding: 0 6px !important;
            line-height: 1 !important;
            transition: background 0.15s;
            border: 1px solid transparent;
        }
        .whm-item__btn .material-symbols-outlined {
            font-size: 14px !important;
        }
        .whm-item__btn--view,
        .whm-item__btn--edit {
            background: #eff6ff;
            border-color: #bfdbfe;
            color: #1d4ed8;
        }
        .whm-item__btn--view:hover,
        .whm-item__btn--edit:hover {
            background: #dbeafe;
        }
        .whm-item__btn--print {
            background: #ecfdf5;
            border-color: #a7f3d0;
            color: #047857;
        }
        .whm-item__btn--print:hover {
            background: #d1fae5;
        }
        .whm-item__btn--del {
            background: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }
        .whm-item__btn--del:hover {
            background: #fee2e2;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .whm-item__row1 {
                display: block;
            }
            .whm-item__info {
                display: block;
                width: 100%;
                padding-right: 0;
                margin-bottom: 8px;
            }
            .whm-item__qr {
                display: inline-block;
                width: auto;
                float: right;
            }
            .whm-item__btns {
                flex-wrap: wrap;
            }
            .whm-item__btn {
                min-width: calc(50% - 3px);
                flex: none;
            }
            .whm-pills {
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 4px;
                scrollbar-width: none;
            }
            .whm-pills::-webkit-scrollbar { display: none; }
            .whm-pills__btn { flex-shrink: 0; }
        }
    </style>

</x-layout>
