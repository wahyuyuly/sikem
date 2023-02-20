<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class TingkatPendidikan extends Model
{
    use Uuid;

    protected $table = 'tingkat_pendidikan';

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
        return $this->hasMany('App\Model\Master\Prodi', 'tingkat_id');
    }
}
