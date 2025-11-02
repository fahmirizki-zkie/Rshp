<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $timestamps = false;
    protected $fillable = [
        'nama_kategori',
    ];

    public function getRouteKeyName()
    {
        return 'idkategori';
    }

    public function getIdAttribute()
    {
        return $this->idkategori;
    }

    // Relationship ke KodeTindakanTerapi
    public function kodeTindakan()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori', 'idkategori');
    }
}