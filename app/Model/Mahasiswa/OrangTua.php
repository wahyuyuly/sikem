<?php

namespace App\Model\Mahasiswa;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use Carbon\Carbon;
use App\Traits\Uppercase;

class OrangTua extends Model
{
    use Uuid;
    use Uppercase;    
    //use SoftDeletes;

    protected $table = 'orang_tua';
    protected $no_upper = ['mahasiswa_id','pendidikan_id'];
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
        'mahasiswa_id', 'jenis', 'nama', 'nik', 'agama', 'pendidikan_id', 'pekerjaan', 'tempat_lahir', 'tanggal_lahir', 'telp', 'penghasilan', 'alamat', 'kelurahan_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'tanggal_lahir'
    ];

    /**
     * Date mutator
     */
    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getTanggalLahirAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * Eloquent relationship
     * 
     */

    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa\Mahasiswa', 'mahasiswa_id');
    }

    public function pendidikan()
    {
        return $this->belongsTo('App\Model\Master\TingkatPendidikan', 'pendidikan_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo('App\Model\Master\Wilayah\Kelurahan', 'kelurahan_id');
    }
}
