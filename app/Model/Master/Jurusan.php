<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Jurusan extends Model
{
    use Uuid;

    protected $table = 'jurusan';

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
        'name', 'description'
    ];

    
    /**
     * Eloquent relationship
     * 
     */
    public function prodi()
    {
        return $this->hasMany('App\Model\Master\Prodi', 'jurusan_id');
    }
}
