<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $timestamps = false;
    protected $fillable = [
        'nama_kategori_klinis',
    ];

    public function getRouteKeyName()
    {
        return 'idkategori_klinis';
    }

    public function getIdAttribute()
    {
        return $this->idkategori_klinis;
    }

    // Relationship ke KodeTindakanTerapi
    public function kodeTindakan()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}