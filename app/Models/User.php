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
        'DNI',
        'name',
        'surname',
        'email',
        'password',
        'phoneNumber1',
        'phoneNumber2',
        'address',
        'photo',
        'FCTDUAL',
        'department_id'
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

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function degrees() {
        return $this->belongsToMany(Degree::class, 'user_degree', 'user_id', 'degree_id')->withPivot('year_of_degree', 'registration_date');
    }

    public function modules() {
        return $this->belongsToMany(Module::class, 'user_module', 'user_id', 'module_id');
    }

}
