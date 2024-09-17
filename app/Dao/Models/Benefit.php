<?php

namespace App\Dao\Models;

use App\Dao\Models\Core\SystemModel;


/**
 * Class Benefit
 *
 * @property $benefit_id
 * @property $benefit_name
 * @property $benefit_description
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Benefit extends SystemModel
{
    protected $perPage = 20;
    protected $table = 'benefit';
    protected $primaryKey = 'benefit_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['benefit_id', 'benefit_name', 'benefit_description'];

    public function getFieldNameAttribute()
    {
        return $this->{self::field_name()};
    }

    public static function field_name()
    {
        return 'benefit_name';
    }

}
