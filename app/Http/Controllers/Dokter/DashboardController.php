<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:dokter');
	}

	public function index() {
		return view('dokter.dashboard');
	}
}
