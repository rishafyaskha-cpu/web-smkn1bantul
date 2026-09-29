<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeachingFactory extends Model
{
    protected $fillable = [
        'title',
        'partner_name',
        'logo',
        'description',
        'program_keahlian_id',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function programKeahlian(): BelongsTo
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset($this->logo) : null;
    }
}
