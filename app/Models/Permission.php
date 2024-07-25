<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Permission extends Model
{
    use HasFactory;

    /**
     * @param array $options
     * @return void
     */
    public function save(array $options = [])
    {
        parent::save($options);
        Cache::clear();
    }
}
