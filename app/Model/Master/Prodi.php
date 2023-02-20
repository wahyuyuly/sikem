<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Prodi extends Model
{
    use Uuid;

    protected $table = 'prodi';

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
        'jurusan_id', 'tingkat_id', 'name', 'description'
    ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    // public function getNameAttribute()
    // {
    //     return "{$this->tingkat->name} - {$this->name}";
    // }

    public function getFullNameAttribute()
    {
        $a = isset($this->tingkat->name) ? $this->tingkat->name : '';
        $b = isset($this->name) ? $this->name : '';
        return "{$a} - {$b}";
    }

    /**
     * Eloquent relationship
     * 
     */

    public function jurusan()
    {
        return $this->belongsTo('App\Model\Master\Jurusan', 'jurusan_id');
    }

    public function tingkat()
    {
        return $this->belongsTo('App\Model\Master\TingkatPendidikan', 'tingkat_id');
    }

    public function mahasiswa()
    {
        return $this->hasOne('App\Model\Mahasiswa\Mahasiswa', 'prodi_id');
    }
}
