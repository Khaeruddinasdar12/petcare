<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NearbyController extends Controller
{
    public function nearby()
    {
    	return view('nearby');
    }
}
