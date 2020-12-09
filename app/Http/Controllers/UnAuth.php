<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Barang;
class UnAuth extends Controller
{
	public function index()
    {
    	$data = Blog::orderBy('updated_at', 'DESC')->limit(4)->get();
    	$brg = Barang::orderBy('created_at', 'DESC')->limit(3)->get();
    	return view('welcome', ['data' => $data, 'brg' => $brg]);
    }

    public function about()
    {
    	return view('about');
    }

    public function produk(Request $request) //halaman tampilkan barang di user
    {
        if($request->cari != '') {
            $data = Barang::orderBy('created_at', 'DESC')
                ->where('nama','like',"%".$request->cari."%")
                ->paginate(10);
        } else {
            $data = Barang::orderBy('created_at', 'DESC')->paginate(10);
        }

        return view('produk', ['data' => $data]);
    }

    public function produkdetail($id) //halaman tampilkan detail barang
    {
        $data = Barang::findOrFail($id);

        return view('produkdetail', ['data' => $data]);
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
