<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class ManageUser extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index(Request $request)
	{
		if($request->cari != '') {
			$data = User::orderBy('created_at', 'DESC')
			->where('name','like',"%".$request->cari."%")
			->paginate(10);
		} else {
			$data = User::select('name', 'email')->paginate(10);
		}


		return view('admin.manage-user', ['data' => $data]);
	}
}
