<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Barang;
use App\Province;
use App\City;
use Illuminate\Support\Facades\Http;
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
        $prov = Province::select('id', 'nama')->get();

        return view('produkdetail', ['data' => $data, 'prov' => $prov]);
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

    public function kabupaten($id)
    {
        $kabupaten = City::where('province_id', $id)->get();
        return $kabupaten;
    }

    public function cekOngkir(Request $request)
    {
        $validasi = $this->validate($request, [
            'kabupaten'     => 'required',
            'provinsi'      => 'required',
            'kurir'         => 'required',
            // 'berat'         => 'required|numeric'
        ],[
            'provinsi.required'  => 'Anda belum memilih provinsi',
            'kabupaten.required' => 'Anda belum memilih kabupaten',
            'kurir.required'     => 'Anda belum memilih kurir',
            // 'berat.required'     => 'Kok bisa beratnya kosong ?',
        ]);

        $berat = $request->berat * $request->jumlah * 1000;
        $response = Http::asForm()->withHeaders([
            'key' => config('app.raja_ongkir_key')
        ])->post('https://api.rajaongkir.com/starter/cost',[
            'origin' => 254, //id kota makassar dari table cities
            'destination' => $request->kabupaten, //id kabupaten tujuan 
            'weight' => $berat, 
            'courier' => $request->kurir
        ]);
        $data = $response['rajaongkir']['results'][0]['costs'];
        return $data;
    }
}
