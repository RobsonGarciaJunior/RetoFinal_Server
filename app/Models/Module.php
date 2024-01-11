<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $visible = ['id', 'name', 'code'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_module', 'module_id', 'user_id')->withPivot('year_of_impartion');
    }
    public function degrees()
    {
        return $this->belongsToMany(Degree::class, 'degree_module', 'module_id', 'degree_id');
    }
}
