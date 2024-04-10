<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class forums_sections extends Model
{
    use HasFactory;
    public function categories(): HasMany
    {
        return $this->hasMany(forums_categories::class,"section_id");
    }
}
