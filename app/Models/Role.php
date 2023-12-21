<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $visible = ['id', 'name'];
    public function roles() {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }

    public const IS_ADMIN = 1;
    public const IS_PROFESSOR = 2;
    public const IS_STUDENT = 3;
}
