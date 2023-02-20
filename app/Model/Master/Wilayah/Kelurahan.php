<?php

namespace App\Model\Master\Wilayah;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelurahan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'kecamatan_id', 'name'
    ];

    /**
     * Relasi.
     */
    public function kecamatan()
    {
        return $this->belongsTo('App\Model\Master\Wilayah\Kecamatan', 'kecamatan_id');
    }
}
