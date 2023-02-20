<?php

namespace App\Model\Mahasiswa;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class MinatBakat extends Model
{
    use Uuid;
    protected $table = 'minat_bakat';

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
        'mahasiswa_id', 'minat_ukm', 'exchange', 'overseas'
    ];

    protected $appends = ['ukm_id'];

    /**
     * Custom function
     */
    public function getUkmAttribute()
    {
        if($this->minat_ukm != null || !empty($this->minat_ukm)) {
            $id = explode(',', $this->minat_ukm);
            $data = \App\Model\Master\UKM::select('name')->whereIn('id', $id)->get();
            $ret = '';
            foreach ($data as $value) {
                $ret = $ret.', '.$value->name;
            }

            return ltrim($ret, ', ');
        } else {
            return null;
        }
    }
    
    /**
     * Relation to mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa\Mahasiswa', 'mahasiswa_id');
    }

    public function bahasa()
    {
        return $this->belongsTo('App\Model\Mahasiswa\Bahasa', 'mahasiswa_id');
    } 
}
