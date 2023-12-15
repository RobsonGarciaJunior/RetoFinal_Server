<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    public function degrees() {
        return $this->belongsToMany(Degree::class, 'degree_module', 'degree_id', 'module_id');
    }
}
