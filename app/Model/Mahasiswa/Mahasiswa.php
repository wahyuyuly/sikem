<?php

namespace App\Model\Mahasiswa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use App\Traits\Uppercase;
use Carbon\Carbon;

class Mahasiswa extends Model
{
    use Uuid;
    use Uppercase;
    use SoftDeletes;

    protected $table = 'mahasiswa';

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
        'npm', 'nama', 'nama_panggilan', 'nik', 'tanggal_lahir', 'tempat_lahir', 'golongan_darah', 'rhesus', 'jenis_kelamin', 'agama', 'suku_bangsa', 'tinggi_badan', 'berat_badan', 'alamat', 'kelurahan_id', 'status_tinggal', 'alamat_tinggal', 'kelurahan_tinggal', 'telp', 'prodi_id', 'tahun_masuk', 'jalur_penerimaan', 'status', 'tanggal_yudisium', 'nama_sekolah', 'jenis_sekolah', 'jurusan_sekolah', 'status_sekolah', 'sekolah_lulus', 'ijazah_sekolah', 'alamat_sekolah', 'riwayat_kesehatan', 'anak_ke', 'jumlah_saudara', 'account_id'
    ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    //protected $appends = ['bapak', 'ibu'];

    /**
     * Accessor
     */
    public function getTanggalLahirAttribute($value)
    {
        return $value != null ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getTanggalYudisiumAttribute($value)
    {
        return $value != null ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getBapakAttribute()
    {
        return $this->orangtua()->where('jenis', 'BAPAK')->first();
    }

    public function getIbuAttribute()
    {
        return $this->orangtua()->where('jenis', 'IBU')->first();
    }

    public function getSdAttribute()
    {
        return $this->riwayat_sekolah()->where('tingkat', 'SD')->first();
    }

    public function getSmpAttribute()
    {
        return $this->riwayat_sekolah()->where('tingkat', 'SMP')->first();
    }

    public function getSmaAttribute()
    {
        return $this->riwayat_sekolah()->where('tingkat', 'SMA')->first();
    }

    /**
     * Eloquent relationship
     * 
     */
    public function account()
    {
        return $this->belongsTo('App\User', 'account_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo('App\Model\Master\Wilayah\Kelurahan', 'kelurahan_id');
    }

    public function kelurahan_domisili()
    {
        return $this->belongsTo('App\Model\Master\Wilayah\Kelurahan', 'kelurahan_tinggal');
    }

    public function prodi()
    {
        return $this->belongsTo('App\Model\Master\Prodi', 'prodi_id');
    }

    public function riwayat_sekolah()
    {
        return $this->hasMany('App\Model\Mahasiswa\RiwayatSekolah');
    }

    public function orangtua()
    {
        return $this->hasMany('App\Model\Mahasiswa\OrangTua');
    }

    public function legalisir()
    {
        return $this->hasMany('App\Model\Permohonan\Legalisir', 'mahasiswa_id');
    }

    public function files()
    {
        return $this->hasMany('App\Model\Mahasiswa\FileMahasiswa', 'mahasiswa_id');
    }

    public function penyakit()
    {
        return $this->hasMany('App\Model\Mahasiswa\Penyakit', 'mahasiswa_id');
    }

    public function minat()
    {
        return $this->hasOne('App\Model\Mahasiswa\MinatBakat', 'mahasiswa_id');
    }

    public function bahasa()
    {
        return $this->hasMany('App\Model\Mahasiswa\Bahasa', 'mahasiswa_id');
    }

    public function semester()
    {
        return $this->hasMany('App\Model\Kemahasiswaan\CapaianSemester', 'mahasiswa_id');
    }

    public function asuransi()
    {
        return $this->hasOne('App\Model\Mahasiswa\Asuransi', 'mahasiswa_id');
    }

    public function kartu()
    {
        return $this->hasOne('App\Model\Mahasiswa\Kartu', 'mahasiswa_id');
    }
}
