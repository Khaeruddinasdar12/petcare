<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dokter;
use Auth;
class DashboardController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:dokter');
	}

	public function index() {
		return view('dokter.dashboard');
	}

	public function profile() {
		return view('dokter.profile');
	}

	public function updateprofile(Request $request) {
		$id = Auth::guard('dokter')->user()->id;
		$data = Dokter::findOrFail($id);
		$data->keterangan = $request->keterangan;
		$data->name = $request->nama;
		$data->save();

		return redirect()->back()->with('success', 'Berhasil mengubah profile');
	}
}
