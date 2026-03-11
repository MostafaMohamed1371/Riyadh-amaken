<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['title', 'description', 'image', 'no_places', 'type'];

    protected function casts(): array
    {
        return ['no_places' => 'integer'];
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
