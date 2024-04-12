<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class forums_topics extends Model
{
    use HasFactory;
    public function user() : HasOne
    {
        return $this->hasOne(User::class,"id","user_id");
    }
    public function posts(): HasMany
    {
        return $this->hasMany(forums_posts::class,"topic_id");
    }
}
