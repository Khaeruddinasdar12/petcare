<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
class Profile extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('profileuser');
	}

	public function update(Request $request)
	{
		$auth_id = Auth::user()->id;
		$data = User::findOrFail($auth_id);

		$data->name = $request->nama;

		$data->save();

		return redirect()->back()->with('success', 'Berhasil Mengubah profile');

	}
}
