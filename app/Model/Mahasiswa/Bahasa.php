<?php

namespace App\Model\Mahasiswa;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Bahasa extends Model
{
    use Uuid;
    protected $table = 'bahasa';

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
        'mahasiswa_id', 'bahasa'
    ];
    
    /**
     * Relation to mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa\Mahasiswa', 'mahasiswa_id');
    }

    public function bakat()
    {
        return $this->belongsTo('App\Model\Mahasiswa\MinatBakat', 'mahasiswa_id');
    }
}
