<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use Illuminate\Support\Facades\Config;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use SoftDeletes;
    use Uuid;

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
        'name', 'username', 'email', 'photo', 'password', 'file', 'description', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['role_access'];

    /**
     * Get the first user role.
     *
     * @param  array  $array
     * @return object
     */

    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    public function getRoleAccessAttribute()
    {
        return $this->getRoleAttribute()->name ?? '';
    }

    /**
     * Eloquent relationship
     * 
     */

    public function mahasiswa()
    {
        return $this->hasOne('App\Model\Mahasiswa\Mahasiswa', 'account_id');
    }
}
