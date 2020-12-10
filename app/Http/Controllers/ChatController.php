<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokter;
class ChatController extends Controller
{
    public function index()
    {
    	return view('chat');
    }

    public function tanyaDokter(Request $request)
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

    	return view('tanya-dokter', ['data' => $data]);
    }
}
