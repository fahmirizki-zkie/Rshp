<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeTindakanTerapi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kode_tindakan_terapi';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idkode_tindakan_terapi';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode',
        'idkategori',
        'idkategori_klinis',
        'deskripsi_tindakan_terapi',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'idkode_tindakan_terapi';
    }

    /**
     * Accessor untuk id (mapping dari idkode_tindakan_terapi)
     *
     * @return int
     */
    public function getIdAttribute()
    {
        return $this->idkode_tindakan_terapi;
    }

    /**
     * Relationship ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    /**
     * Relationship ke KategoriKlinis
     */
    public function kategoriKlinis()
    {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}
