<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class UKM extends Model
{
    use Uuid;

    protected $table = 'ukm';

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
    public function minat()
    {
        return $this->hasMany('App\Model\Mahasiswa\MinatBakat', 'ukm_id');
    }
}
