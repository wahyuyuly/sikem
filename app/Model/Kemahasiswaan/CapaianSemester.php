<?php

namespace App\Model\Kemahasiswaan;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class CapaianSemester extends Model
{
    use Uuid;

    protected $table = 'capaian_semester';

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
        'mahasiswa_id', 'semester', 'jumlah_sks', 'ipk', 'file'
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
