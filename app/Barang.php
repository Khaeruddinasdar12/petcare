<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
	protected $fillable = [
		'nama', 'harga', 'stok', 'keterangan', 'gambar'
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
