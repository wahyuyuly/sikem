<?php

namespace App\Model\Kemahasiswaan;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class RiwayatUkm extends Model
{
    use Uuid;

    protected $table = 'riwayat_ukm';
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mahasiswa_id', 'ukm_id', 'lainnya'
    ];

    /**
     * Eloquent relationship
     * 
     */

    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa\Mahasiswa', 'mahasiswa_id');
    }

    public function ukm()
    {
        return $this->belongsTo('App\Model\Master\UKM', 'ukm_id');
    }
}
