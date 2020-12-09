<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pesanan;
use Auth;
class PesananController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function sendBukti(Request $request, $id) {
		// return $id;
		$data = Pesanan::findOrFail($id);
		$gambar = $request->file('gambar');
            if ($gambar) {
                if ($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) {
                    \Storage::delete('public/' . $data->gambar);
                }
                $gambar_path = $gambar->store('bukti', 'public');
                $data->bukti = $gambar_path;
            }
        $data->save();
        return redirect()->back()->with('success', 'Berhasil mengupload bukti transfer');

	}
	public function pesanan(Request $request) { // belum dikonfirmasi admin
		if($request->get('cari') != '') {
			$data = Pesanan::where('user_id', Auth::user()->id)
			->where(function ($query) use ($request) {
				$query->whereHas('barang', function ($query) use($request){
					$query->where('nama', 'like', '%'.$request->get('cari').'%');
				});
			})
			->where('status', '0')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		} else {
			$data = Pesanan::where('user_id', Auth::user()->id)
			->where('status', '0')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		}
		
				// return $data;
		return view('pesanan', ['data' => $data]);
	}

	public function riwayat(Request $request) { // riwayat pesanan
		if($request->get('cari') != '') {
			$data = Pesanan::where('user_id', Auth::user()->id)
			->where(function ($query) use ($request) {
				$query->whereHas('barang', function ($query) use($request){
					$query->where('nama', 'like', '%'.$request->get('cari').'%');
				});
			})
			->where('status', '1')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		} else {
			$data = Pesanan::where('user_id', Auth::user()->id)
			->where('status', '1')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		}
		
				// return $data;
		return view('pesanan-riwayat', ['data' => $data]);
	}

	public function batal(Request $request) { // pesanan yang dibatalkan
		if($request->get('cari') != '') {
			$data = Pesanan::where('user_id', Auth::user()->id)
			->where(function ($query) use ($request) {
				$query->whereHas('barang', function ($query) use($request){
					$query->where('nama', 'like', '%'.$request->get('cari').'%');
				});
			})
			->where('status', '2')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		} else {
			$data = Pesanan::where('user_id', Auth::user()->id)
			->where('status', '2')
			->with('barang:id,nama')
			->orderBy('created_at', 'DESC')
			->paginate(10);
		}
		
				// return $data;
		return view('pesanan-batal', ['data' => $data]);
	}
}
