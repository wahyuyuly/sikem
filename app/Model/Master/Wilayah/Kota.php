<?php

namespace App\Model\Master\Wilayah;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kota';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'provinisi_id', 'name'
    ];

    /**
     * Relasi.
     */
    public function kecamatan()
    {
        return $this->hasMany('App\Model\Master\Wilayah\Kecamatan');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Model\Master\Wilayah\Provinsi', 'provinsi_id');
    }
}
