<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'role_user'; // Nama tabel yang benar
    protected $primaryKey = 'idrole_user';
    public $timestamps = false;

    protected $fillable = [
        'iduser',
        'idrole',
        'status',
    ];

    /**
     * Relationship: User Role belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /**
     * Relationship: User Role belongs to a Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}
