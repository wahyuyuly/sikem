<?php

namespace App\Model\Permohonan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use Carbon\Carbon;

class Legalisir extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $table = 'legalisir';

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
        'mahasiswa_id', 'nomor', 'jenis', 'keterangan', 'file', 'status', 'alasan_tolak', 'dokumen', 'tanggal_ambil', 'bukti_ambil'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'tanggal_ambil',
    ];

    /**
     * Accessor
     */
    public function getCreatedAtAttribute($value)
    {
        return $value != null ? Carbon::parse($value)->format('d M Y') : null;
    }

    /**
     * Eloquent relationship
     * 
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa\Mahasiswa', 'mahasiswa_id');
    }
}
