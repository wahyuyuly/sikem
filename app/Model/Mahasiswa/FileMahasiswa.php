<?php

namespace App\Model\Mahasiswa;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class FileMahasiswa extends Model
{
    use Uuid;

    protected $table = 'file';

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
        'mahasiswa_id', 'name', 'file', 'description'
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
