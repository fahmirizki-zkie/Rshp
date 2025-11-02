<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRekamMedisLaravel extends Model
{
    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';
    public $timestamps = false;
    
    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi',
        'detail',
    ];

    // Relationship ke RekamMedis
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedisLaravel::class, 'idrekam_medis', 'idrekam_medis');
    }

    // Relationship ke KodeTindakanTerapi
    public function kodeTindakanTerapi()
    {
        return $this->belongsTo(KodeTindakanTerapi::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }
}
