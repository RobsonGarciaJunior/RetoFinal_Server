<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class User extends Model
{
    use HasFactory;

    //BELONG
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class, 'degree_id');
    }

    //TENGO QUE CREAR EL MODELO DE ROLE_USER? para refenciar aqui esas dos claves primarias
    //O puedo coger directamente de aqui la ID de este misma clase y la id de la clase con la que se relaciona en la nueva tabla?

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function degrees() {
        return $this->belongsToMany(Degree::class, 'user_degree', 'user_id', 'degree_id');
    }

}
