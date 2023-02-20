<?php

namespace App\Model\Artikel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Carbon\Carbon;

class Artikel extends Model
{
    use Uuid;
    use Sluggable;
    use SluggableScopeHelpers;
    use SoftDeletes;

    protected $table = 'posts';

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
        'category_id', 'title', 'content', 'image', 'status', 'comment_status', 'hit', 'user_id'
    ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['date_id'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Mutator and Accessor
     * 
     */

     public function getDateIdAttribute() {
        return Carbon::parse($this->attributes['updated_at'])->format('d M Y');
     }

    /**
     * Eloquent relationship
     * 
     */

    public function category()
    {
        return $this->belongsTo('App\Model\Artikel\Kategori', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
