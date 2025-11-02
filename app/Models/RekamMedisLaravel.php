<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedisLaravel extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null; // tidak ada updated_at
    
    protected $fillable = [
        'created_at',
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idreservasi_dokter',
        'dokter_pemeriksa',
    ];

    // Relationship ke TemuDokter (reservasi_dokter)
    public function temuDokter()
    {
        return $this->belongsTo(TemuDokterLaravel::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    // Relationship ke User (dokter pemeriksa)
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_pemeriksa', 'iduser');
    }

    // Relationship ke DetailRekamMedis (one to many)
    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedisLaravel::class, 'idrekam_medis', 'idrekam_medis');
    }

    // Helper untuk get data lengkap dengan join
    public static function getAllJoined()
    {
        return self::with([
            'temuDokter.pet.pemilik.user',
            'temuDokter.pet.rasHewan.jenisHewan',
            'temuDokter.roleUser.user',
            'dokter'
        ])->orderBy('created_at', 'desc')->get();
    }

    // Helper untuk get by ID dengan join
    public static function getByIdJoined($id)
    {
        return self::with([
            'temuDokter.pet.pemilik.user',
            'temuDokter.pet.rasHewan.jenisHewan',
            'temuDokter.roleUser.user',
            'dokter',
            'detailRekamMedis.kodeTindakan.kategori',
            'detailRekamMedis.kodeTindakan.kategoriKlinis'
        ])->find($id);
    }
}
