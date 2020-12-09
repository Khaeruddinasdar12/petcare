<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dokter;
class ManageDokter extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request) //dokter belum aktif (belum terkonfirmasi)
    {
    	if($request->cari != '') {
            $data = Dokter::orderBy('created_at', 'DESC')
                ->where('name','like',"%".$request->cari."%")
                ->where('status', '0')
                ->paginate(10);
        } else {
            $data = Dokter::orderBy('created_at', 'DESC')
                ->where('status', '0')
                ->paginate(10);
        }
        // return $data;
        return view('admin.dokter.index', ['data' => $data]);
    }

    public function aktif(Request $request) //dokter aktif telah terkonfirmasi
    {
        if($request->cari != '') {
            $data = Dokter::orderBy('created_at', 'DESC')
                ->where('name','like',"%".$request->cari."%")
                ->where('status', '1')
                ->paginate(10);
        } else {
            $data = Dokter::orderBy('created_at', 'DESC')
                ->where('status', '1')
                ->paginate(10);
        }
        // return $data;
        return view('admin.dokter.dokter-aktif', ['data' => $data]);
    }

    public function konfirmasi($id)
    {
        $data = Dokter::findOrFail($id);
        $data->status = '1'; //aktif
        $data->save();

        return redirect()->back()->with('success', 'Dokter '.$data->name.' telah aktif');
    }
}
