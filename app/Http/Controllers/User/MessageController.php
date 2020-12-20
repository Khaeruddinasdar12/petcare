<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index($id) 
	{
		return view('chat-user.index');
	}
}
