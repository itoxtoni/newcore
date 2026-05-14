<?php
namespace App\Models;

use App\Dao\Models\Core\SystemModel;

class Category extends SystemModel
{
    protected $table   = 'category';
    public $timestamps = false;

    protected $primaryKey = 'category_id';

    public $filterable = [
        'category_nama' => 'Category Nama',
        'category_id' => 'Category ID',
    ];

    public $sortable = [
        'category_nama' => 'Category Nama',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['category_id', 'category_nama', 'category_keterangan'];

    public static function field_name()
    {
        return 'category_nama';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
