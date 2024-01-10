<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    protected $visible = ['id', 'name', 'modules'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_degree', 'degree_id', 'user_id')->withPivot('year_of_degree', 'registration_date');
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'degree_module', 'degree_id', 'module_id');
    }
    //BELONG
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
