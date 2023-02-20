<?php

namespace App\Model\Kemahasiswaan;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PendidikanNonFormal extends Model
{
    use Uuid;

    protected $table = 'pendidikan_non_formal';
    
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
        'mahasiswa_id', 'jenis', 'nama', 'penyelenggara', 'tanggal', 'lama', 'satuan'
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
