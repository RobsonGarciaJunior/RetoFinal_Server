<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'departmentId'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //BELONG
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
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
