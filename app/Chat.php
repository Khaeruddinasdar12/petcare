<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	protected $table = 'chats';

	protected $fillable = [
		'user_id', 'dokter_id', 'pesan', 'from'
	];

	public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function dokter()
    {
        return $this->belongsTo('App\Dokter', 'dokter_id');
    }

    public function getCreatedAtAttribute()
	{
		return \Carbon\Carbon::parse($this->attributes['created_at'])
		->diffForHumans();
	}
}
