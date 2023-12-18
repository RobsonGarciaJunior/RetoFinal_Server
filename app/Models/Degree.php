<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsToMany(User::class, 'user_degree', 'user_id', 'degree_id')->withPivot('year_of_degree', 'registration_date');
    }
    public function modules() {
        return $this->belongsToMany(Module::class, 'degree_module', 'degree_id', 'module_id');
    }
}
