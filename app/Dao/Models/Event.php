<?php

namespace App\Dao\Models;

use App\Dao\Models\Core\SystemModel;

/**
 * Class Event
 *
 * @property $event_id
 * @property $event_name
 * @property $event_price
 * @property $event_description
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Event extends SystemModel
{
    protected $perPage = 20;

    protected $table = 'event';

    protected $primaryKey = 'event_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['event_id', 'event_name', 'event_price', 'event_date', 'event_description', 'event_info'];

    public static function field_name()
    {
        return 'event_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{self::field_name()};
    }
}
