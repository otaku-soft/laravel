<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class forums_categories extends Model
{
    use HasFactory;

    public function topics(): HasMany
    {
        return $this->hasMany(forums_topics::class,"category_id");
    }
}
