<?php

namespace App\Model\Master\Wilayah;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provinsi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name'
    ];

    /**
     * Ambil data kota.
     */
    public function kota()
    {
        return $this->hasMany('App\Model\Master\Wilayah\Kota');
    }
}
