<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Chat;
// use App\Dokter;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class MessageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index($id) 
	{
		$auth_id = Auth::user()->id;
		$chat = Chat::where('user_id', $auth_id)->where('dokter_id', $id)->get();

		// return $chat;

		return view('chat-user.index', ['chat' => $chat]);
	}

	public function store(Request $request)
	{
		$data = new Chat;
		$data->user_id = Auth::user()->id;
		$data->dokter_id = $request->dokter_id;
		$data->pesan = $request->pesan;
		$data->from = '1';
		$data->save();

		$this->broadcast(Auth::user()->name, $request->pesan);

		return redirect()->back();
	}

	private function broadcast($senderName, $message)
	{
		$rute = 
		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(60*20);

		$notificationBuilder = new PayloadNotificationBuilder('Pesan dari :'. $senderName);
		$notificationBuilder->setBody($message)
		->setSound('default')
		->setClickAction('http://localhost:8000/tanya-dokter/1/chat');

		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData([
			'sender_name' => $senderName,
			'message' => $message
		]);

		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();

		$token = User::all()->pluck('fcm_token')->toArray();
		$downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

		return $downstreamResponse->numberSuccess();;
	}
}
