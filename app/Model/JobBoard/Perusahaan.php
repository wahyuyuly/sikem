<?php

namespace App\Model\JobBoard;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Perusahaan extends Model
{
    use Uuid;

    protected $table = 'job_perusahaan';

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
        'name', 'description', 'logo', 'url', 'foto', 'user_id'
    ];

    /**
     * Eloquent relationship
     * 
     */

    public function category()
    {
        return $this->belongsTo('App\Model\JobBoard\Kategori', 'category_id');
    }
}
