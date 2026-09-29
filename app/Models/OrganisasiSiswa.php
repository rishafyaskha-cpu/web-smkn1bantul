<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganisasiSiswa extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'description',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
