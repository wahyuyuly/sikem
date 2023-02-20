<?php

namespace App\Model\Mahasiswa;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class RiwayatSekolah extends Model
{
    use Uuid;
    protected $table = 'riwayat_sekolah';

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
        'mahasiswa_id', 'tingkat', 'sma', 'jurusan', 'nama', 'tahun_masuk', 'tahun_lulus', 'nilai', 'ijazah'
    ];
    
    /**
     * Relation to mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa\Mahasiswa', 'mahasiswa_id');
    }
}
