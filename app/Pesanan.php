<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';

	protected $fillable = [
		'nama', 'alamat', 'jumlah', 'total', 'barang_id', 'user_id', 'status', 'keterangan', 'bukti'
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

	public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id');
    }
}
