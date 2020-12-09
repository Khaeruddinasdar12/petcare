<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $psn = Pesanan::where('user_id', Auth::user()->id)
            ->where('status', '0')
            ->count();
        $rwyt = Pesanan::where('user_id', Auth::user()->id)
            ->where('status', '1')
            ->count();
        $btl = Pesanan::where('user_id', Auth::user()->id)
            ->where('status', '2')
            ->count();
        
        return view('home', [
            'psn' => $psn,
            'btl' => $btl,
            'rwyt' => $rwyt
        ]);
    }
}
