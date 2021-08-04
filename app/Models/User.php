<?php

namespace SlimMonsterKit\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'hash',
        'admin',
        'last_access'
    ];

    protected $hidden = [
        'password',
        'hash'
    ];

    public function updateLastAccess()
    {
        $this->last_access = date('Y-m-d H:i:s');
        $this->save();
        return $this;
    }
}
