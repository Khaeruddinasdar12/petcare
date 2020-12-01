<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
    	'judul', 'slug', 'gambar', 'artikel', 'admin_id', 'dokter_id'
    ];
}
