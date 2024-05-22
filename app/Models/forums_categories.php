<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class forums_categories extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @return HasMany
     */
    public function topics(): HasMany
    {
        return $this->hasMany(forums_topics::class, "category_id");
    }
}
