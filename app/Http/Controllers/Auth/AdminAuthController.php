<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminAuthController extends Controller
{
	use AuthenticatesUsers;

	protected $maxAttempts = 3;
	protected $decayMinutes = 2;

	public function __construct()
	{
		$this->middleware('guest:admin')->except('postLogout');
	}

	public function getLogin()
	{
		return view('admin.login');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:8'
		]);

		if (auth()->guard('admin')->attempt($request->only('email', 'password'))) {
			$request->session()->regenerate();
			$this->clearLoginAttempts($request);
			return redirect()->intended(route('admin.dashboard'));
		} else {
			$this->incrementLoginAttempts($request);

			return redirect()
			->back()
			->withInput()
			->withErrors(["Incorrect user login details!"]);
		}
	}

	public function postLogout()
	{
		auth()->guard('admin')->logout();
		// session()->flush();

		return redirect()->route('admin.login');
	}

	// public function logout()
 //    {
 //        Auth::logout();
 //        return redirect('/')->with('status','User has been logged out!');
 //    }
}
