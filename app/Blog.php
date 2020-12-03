<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $table = 'blogs';

	protected $fillable = [
		'judul', 'slug', 'gambar', 'artikel', 'admin_id', 'dokter_id'
	];

	public function getCreatedAtAttribute()
	{
		return \Carbon\Carbon::parse($this->attributes['created_at'])
		->translatedFormat('l, d F Y');
	}

	public function getUpdatedAtAttribute()
	{
		return \Carbon\Carbon::parse($this->attributes['updated_at'])
		->diffForHumans();
	}
}
