<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pesanan;
class PesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function konfirmasi($id)
	{
		$data = Pesanan::findOrFail($id);
		$data->status = '1';
		$data->save();

		return redirect()->back()->with('success', 'Transaksi berhasil');
	}

    public function pesanan(Request $request) { // belum dikonfirmasi admin
		if($request->get('cari') != '') {
			$data = Pesanan::where(function ($query) use ($request) {
				$query->whereHas('barang', function ($query) use($request){
					$query->where('nama', 'like', '%'.$request->get('cari').'%');
				});
			})
			->where('status', '0')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		} else {
			$data = Pesanan::where('status', '0')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		}
		
				// return $data;
		return view('admin.pesanan.index', ['data' => $data]);
	}

	public function riwayat(Request $request) { // riwayat pesanan
		if($request->get('cari') != '') {
			$data = Pesanan::where(function ($query) use ($request) {
				$query->whereHas('barang', function ($query) use($request){
					$query->where('nama', 'like', '%'.$request->get('cari').'%');
				});
			})
			->where('status', '1')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		} else {
			$data = Pesanan::where('status', '1')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		}
		
				// return $data;
		return view('admin.pesanan.riwayat', ['data' => $data]);
	}

	public function delete(Request $request, $id)
	{
		$data = Pesanan::findOrFail($id);
		$data->status = '2';
		$data->keterangan = $request->keterangan;
		$data->save();

		return redirect()->back()->with('success', 'Berhasil membatalkan pemesanan');
	}
}
