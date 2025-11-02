<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = true;
    
    protected $fillable = [
        'iduser',
        'no_wa',
        'alamat'
    ];

    /**
     * Relationship: Pemilik belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /**
     * Relationship: Pemilik has many Pets
     */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }

    /**
     * Get route key name
     */
    public function getRouteKeyName()
    {
        return 'idpemilik';
    }
}