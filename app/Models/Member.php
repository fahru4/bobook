<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $guard = 'member';

    protected $fillable = [
        'name',
        'username',
        'password',
        'photo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function transactionAll(){
        return $this->hasMany(Transaction::class,'member_id');
    }

}
