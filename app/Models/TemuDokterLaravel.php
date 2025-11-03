<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokterLaravel extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $timestamps = false;

    protected $fillable = [
        'no_urut',
        'waktu_daftar',
        'status',
        'idpet',
        'idrole_user',
    ];

    /**
     * Relationship: TemuDokter belongs to Pet
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    /**
     * Relationship: TemuDokter belongs to RoleUser (dokter)
     */
    public function roleUser()
    {
        return $this->belongsTo(UserRole::class, 'idrole_user', 'idrole_user');
    }

    /**
     * Get route key name
     */
    public function getRouteKeyName()
    {
        return 'idreservasi_dokter';
    }
}
