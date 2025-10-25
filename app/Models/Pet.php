<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan',
    ];

    //Get the route key for the model.
    public function getRouteKeyName()
    {
        return 'idpet';
    }

    //Accessor for 'id' attribute (maps to 'idpet')
    public function getIdAttribute()
    {
        return $this->attributes['idpet'] ?? null;
    }

    //Relationship: Pet belongs to a Pemilik (Owner)
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    //Relationship: Pet belongs to a RasHewan (Breed)
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }
}
