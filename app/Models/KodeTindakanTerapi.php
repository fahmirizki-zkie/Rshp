<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeTindakanTerapi extends Model
{
    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    public $timestamps = false;
    protected $fillable = [
        'kode',
        'idkategori',
        'idkategori_klinis',
        'deskripsi_tindakan_terapi',
    ];

    public function getRouteKeyName()
    {
        return 'idkode_tindakan_terapi';
    }

    public function getIdAttribute()
    {
        return $this->idkode_tindakan_terapi;
    }

    //Relationship ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    //Relationship ke KategoriKlinis
    public function kategoriKlinis()
    {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis', 'idkategori_klinis');
    }

    // Helper method untuk get all dengan join (Laravel way)
    public static function getAllJoined()
    {
        return self::with(['kategori', 'kategoriKlinis'])
            ->orderBy('idkode_tindakan_terapi', 'asc')
            ->get();
    }
}