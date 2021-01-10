<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Dokter;
use App\User;
class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index() {
		$jmlblog = Blog::count();
		$jmldokter = Dokter::where('status', '1')->count();
		$jmluser = User::count();
		return view('admin.dashboard', [
			'jmlblog' => $jmlblog,
			'jmluser' => $jmluser,
			'jmldokter' => $jmldokter
		]);
	}
}
