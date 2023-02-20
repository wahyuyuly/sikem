<?php

namespace App\Traits;

trait Uppercase
{
    /**
     * Default params that will be saved on lowercase
     * @var array No Uppercase keys
     */
    protected $no_uppercase = [
        'id',
        'user_id',
        'password',
        'username',
        'email',
        'remember_token',
        'slug',
        'prodi_id',
        'account_id',
        'jurusan_id',
        'tingkat_id',
        'pendidikan_id'
    ];

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
        if (is_string($value)) {
            if($this->no_upper !== null){
                if (!in_array($key, $this->no_uppercase)) {
                    if(!in_array($key, $this->no_upper)){
                        $this->attributes[$key] = trim(strtoupper($value));
                    }
                }
            }else{
                if (!in_array($key, $this->no_uppercase)) {
                    $this->attributes[$key] = trim(strtoupper($value));
                }
            }
        }
    }
}