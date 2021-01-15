<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Auth;
class Profile extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('admin.profile');
	}

	public function update(Request $request)
	{
		$auth_id = Auth::guard('admin')->user()->id;
		$data = Admin::findOrFail($auth_id);

		$data->name = $request->nama;

		$data->save();

		return redirect()->back()->with('success', 'Berhasil Mengubah profile');

	}
}
