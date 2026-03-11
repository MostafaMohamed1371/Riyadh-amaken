<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'tags',
        'location',
        'working_hours',
        'phone',
        'rate',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'rate' => 'decimal:2',
            'category_id' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
