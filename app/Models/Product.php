<?php

namespace App\Models;

use App\Dao\Models\Core\SystemModel;


/**
 * Class Product
 *
 * @property $product_id
 * @property $product_nama
 * @property $product_sku
 * @property $product_barcode
 * @property $product_id_category
 * @property $product_tag
 * @property $product_description
 * @property $product_satuan
 * @property $product_harga
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Product extends SystemModel
{
    protected $perPage = 20;
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['product_id', 'product_nama', 'product_sku', 'product_barcode', 'product_id_category', 'product_tag', 'product_description', 'product_satuan', 'product_harga', 'product_image'];


}
