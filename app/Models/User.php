<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $fillable = [
        'nama',  // Database column name
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'iduser';
    }

    /**
     * Accessor for 'id' attribute (maps to 'iduser')
     */
    public function getIdAttribute()
    {
        return $this->attributes['iduser'] ?? null;
    }

    /**
     * Accessor for 'name' attribute (maps to 'nama')
     */
    public function getNameAttribute()
    {
        return $this->attributes['nama'] ?? null;
    }

    /**
     * Mutator for 'name' attribute (sets 'nama')
     */
    public function setNameAttribute($value)
    {
        $this->attributes['nama'] = $value;
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    /**
     * Relationship: A user can have many roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status', 'idrole_user');
    }
}
