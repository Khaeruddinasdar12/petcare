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

    public function index(Request $request)
    {
    	if($request->cari != '') {
            $data = Dokter::orderBy('created_at', 'DESC')
                ->where('name','like',"%".$request->cari."%")
                ->paginate(10);
        } else {
            $data = Dokter::orderBy('created_at', 'DESC')->paginate(10);
        }
        // return $data;
        return view('admin.dokter.index', ['data' => $data]);
    }
}
