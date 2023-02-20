<?php

namespace App\Model\Pengumuman;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class KategoriPengumuman extends Model
{
    use Uuid;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'kategori_pengumuman';

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
        'name', 'description', 'status', 'user_id'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Eloquent relationship
     * 
     */

    public function pengumuman()
    {
        return $this->hasMany('App\Model\Pengumuman\Pengumuman', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
