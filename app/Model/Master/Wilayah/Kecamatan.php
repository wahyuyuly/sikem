<?php

namespace App\Model\Master\Wilayah;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kecamatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'kota_id', 'nama'
    ];

    /**
     * Relasi.
     */
    public function kelurahan()
    {
        return $this->hasMany('App\Model\Master\Wilayah\Kelurahan');
    }

    public function kota()
    {
        return $this->belongsTo('App\Model\Master\Wilayah\Kota', 'kota_id');
    }
}
