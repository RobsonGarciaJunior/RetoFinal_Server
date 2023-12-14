<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'degree_id');
    }

}
