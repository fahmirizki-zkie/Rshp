<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kategori_klinis';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idkategori_klinis';

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
        'nama_kategori_klinis',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'idkategori_klinis';
    }

    /**
     * Accessor untuk id (mapping dari idkategori_klinis)
     * Untuk kemudahan akses di view dengan $kategoriKlinis->id
     *
     * @return int
     */
    public function getIdAttribute()
    {
        return $this->idkategori_klinis;
    }
}
