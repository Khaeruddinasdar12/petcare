<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dokter extends Authenticatable
{
    use Notifiable;

    protected $guard = 'dokter';

    protected $fillable = [
        'name', 'email', 'username', 'password','email_verfied_at', 'keterangan'
    ];

    protected $hidden = ['password'];
}
