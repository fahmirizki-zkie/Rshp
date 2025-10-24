<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kategori';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idkategori';

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
        'nama_kategori',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'idkategori';
    }

    /**
     * Accessor untuk id (mapping dari idkategori)
     * Untuk kemudahan akses di view dengan $kategori->id
     *
     * @return int
     */
    public function getIdAttribute()
    {
        return $this->idkategori;
    }
}
