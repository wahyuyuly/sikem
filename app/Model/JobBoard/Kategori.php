<?php

namespace App\Model\JobBoard;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Kategori extends Model
{
    use Uuid;

    protected $table = 'job_kategori';

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
        'name', 'description', 'user_id'
    ];

    /**
     * Eloquent relationship
     * 
     */

    public function job()
    {
        return $this->belongsTo('App\Model\JobBoard\Job', 'category_id');
    }
}
