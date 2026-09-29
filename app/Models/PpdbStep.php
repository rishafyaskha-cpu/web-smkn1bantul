<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbStep extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'sort_order',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
