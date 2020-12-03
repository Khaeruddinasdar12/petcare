<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
class UnAuth extends Controller
{
	public function index()
    {
    	$data = Blog::orderBy('updated_at', 'DESC')->limit(4)->get();
    	// return $data;
    	return view('welcome', ['data' => $data]);
    }

    public function about()
    {
    	return view('about');
    }

    public function blog(Request $request)
    {
        if($request->cari != '') {
            $data = Blog::orderBy('updated_at', 'DESC')
                ->where('judul','like',"%".$request->cari."%")
                ->paginate(10);
        } else {
            $data = Blog::orderBy('updated_at', 'DESC')->paginate(10);
        }

        return view('allblog', ['data' => $data]);
    }
}
