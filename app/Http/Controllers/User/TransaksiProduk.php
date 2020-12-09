<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
use App\Pesanan;
use Auth;
class TransaksiProduk extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function transaksi(Request $request, $id)
	{
		$validasi = $this->validate($request, [
            'nama'   => 'required|string',
            'alamat' => 'required|string',
            'jumlah' => 'required|numeric|min:1'
        ]);

		$data = Barang::findOrFail($id);

		if($data->stok < $request->jumlah) {
			return redirect()->back()->with('error', 'Stok tidak cukup');
		}

		$latest= Pesanan::latest('id')->pluck('id')->first(); //id terakhir dari pesanan
		// return $latest;
		$input = new Pesanan;
		$input->nama = $request->nama;
		$input->alamat = $request->alamat;
		$input->jumlah = $request->jumlah;
		$input->harga = $data->harga;
		$input->total = $data->harga * $request->jumlah + $latest + 1;
		$input->barang_id = $data->id;
		$input->status = '0'; // belum 
		$input->nohp = $request->nohp;
		$input->user_id = Auth::user()->id;
		$input->save();

		return redirect()->back()->with('success', $input->total);
	}
}
