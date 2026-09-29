<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteStatistic extends Model
{
    protected $fillable = [
        'label',
        'value',
        'sort_order',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
