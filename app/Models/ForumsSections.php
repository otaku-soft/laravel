<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumsSections extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(ForumsCategories::class,"section_id");
    }
}