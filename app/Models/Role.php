<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;

    protected $fillable = [
        'nama_role',
        'deskripsi',
    ];

    //Get the route key for the model.
    public function getRouteKeyName()
    {
        return 'idrole';
    }

    //Accessor for 'id' attribute (maps to 'idrole')
    public function getIdAttribute()
    {
        return $this->attributes['idrole'] ?? null;
    }

    //Accessor for 'name' attribute (maps to 'nama_role')
    public function getNameAttribute()
    {
        return $this->attributes['nama_role'] ?? null;
    }

    //Relationship: A role can have many users
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser')
                    ->withPivot('status');
    }
}
