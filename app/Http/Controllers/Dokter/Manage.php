<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dokter;
// use AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class Manage extends Controller
{	
	use AuthenticatesUsers;
    public function regisdokter() //halaman registrasi admin
    {

        return view('dokter.register');
    }

    public function store(Request $request) // input data dokter
    {
    	$validasi = $this->validate($request, [
            'name'     	=> 'required|string',
            'password'  => 'required|string|min:8|confirmed',
            'email'		=> 'required|email|string|unique:dokters',
            'keterangan'=> 'required|string'
        ]);

        $data = new Dokter;
        $data->name = $request->name;
        $data->keterangan = $request->keterangan;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->status = '0';
        $data->save();

        if (auth()->guard('dokter')->attempt($request->only('email', 'password'))) {
			$request->session()->regenerate();
			$this->clearLoginAttempts($request);
			return redirect()->intended(route('dokter.dashboard'));
		} else {
			$this->incrementLoginAttempts($request);

			return redirect()
			->back()
			->withInput()
			->withErrors(["Incorrect user login details!"]);
		}
        // return redirect()->route('dokter.dashboard')->with('success', 'Proses daftar sebagai dokter berhasil! menunggu verifikasi admin');
    }
}
