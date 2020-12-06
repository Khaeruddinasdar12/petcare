<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
class ManageBarang extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        if($request->cari != '') {
            $data = Barang::orderBy('created_at', 'DESC')
            ->where('nama','like',"%".$request->cari."%")
            ->paginate(10);
        } else {
            $data = Barang::orderBy('created_at', 'DESC')->paginate(10);
        }
        // return $data;
        return view('admin.barang.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $validasi = $this->validate($request, [
            'nama'          => 'required|string',
            'harga'         => 'required|numeric',
            'stok'          => 'required|numeric',
            'keterangan'    => 'required|string',
            'gambar'        => 'image|mimes:jpeg,png,jpg|max:3072'
        ]);

        $data = new Barang;
        $data->nama = $request->nama;
        $data->harga = $request->harga;


        $gambar = $request->file('gambar');
        if ($gambar) {
            $gambar_path = $gambar->store('gambar', 'public');
            $data->gambar = $gambar_path;
        }

        $data->stok = $request->stok;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect()->back()->with('success', $data->id);
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        return view('admin.barang.edit', ['data' => $data]); 
    }

    public function update(Request $request, $id)
    {
        $validasi = $this->validate($request, [
            'nama'          => 'required|string',
            'harga'         => 'required|numeric',
            'stok'          => 'required|numeric',
            'keterangan'    => 'required|string',
            'gambar'        => 'image|mimes:jpeg,png,jpg|max:3072'
        ]);

        $data = Barang::findOrFail($id);
        $data->nama = $request->nama;
        $data->harga = $request->harga;


        $gambar = $request->file('gambar');
        if ($gambar) {
            if ($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) {
                \Storage::delete('public/' . $data->gambar);
            }
            $gambar_path = $gambar->store('gambar', 'public');
            $data->gambar = $gambar_path;
        }

        $data->stok = $request->stok;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect()->back()->with('success', $data->id);
    }

    public function destroy($id)
    {
        $data = Barang::findOrFail($id);
        if ($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) {
            \Storage::delete('public/' . $data->gambar);
        }
        $data->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Barang');
    }
}
