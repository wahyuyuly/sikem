<?php

namespace App\Model\Kemahasiswaan;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Organisasi extends Model
{
    use Uuid;

    protected $table = 'organisasi';

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
        'mahasiswa_id', 'nama', 'tahun_sk'
    ];

    /**
     * Eloquent relationship
     * 
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa\Mahasiswa', 'mahasiswa_id');
    }
}
