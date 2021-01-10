<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dokter;
use App\User;
use Auth;
use App\Chat;
// use App\Dokter;
use DB;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class MessageController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:dokter');
	}

	public function index($id) 
	{

		$auth_id = Auth::guard('dokter')->user()->id; //id dokter sedang login

		//user yang pernah chat dengan dokter

		// $user = Chat::
		// 		// select('user_id', 'created_at', 'pesan')
		// 		distinct('user_id')
		// 		->max('created_at')
		// 		// ->where('dokter_id', $auth_id)
		// 		// ->orderBy('created_at', 'desc')
		// // 		// ->with('user:id,name')
		// 		->groupBy('user_id')
		// 		->get();
		// 		// $filter = $user->latest();
		// $user = Chat::distinct()->orderBy('created_at', 'desc')->groupBy('user_id')->get();
		// $user = DB::table('chats')
		// 	->selectRaw('distinct(chats.user_id), max(chats.created_at), users.name')
		// 	->join('users', 'users.id', '=', 'chats.user_id')
		// 	->groupBy('chats.user_id')
		// 	->orderBy('max(chats.created_at)', 'desc')
		// 	->get();
		$user = DB::select(DB::raw("select distinct chats.user_id, max(chats.created_at) as waktu, users.name from chats join users on chats.user_id = users.id group by chats.user_id, users.name order by max(chats.created_at) desc, chats.user_id"));
		// return $user;

		$chat = Chat::where('user_id', $id)->where('dokter_id', $auth_id)->get();

		// return $chat;

		return view('dokter.chat', ['chat' => $chat, 'user' => $user]);
	}

	public function store(Request $request)
	{
		$data = new Chat;
		$data->user_id = Auth::user()->id;
		$data->dokter_id = $request->dokter_id;
		$data->pesan = $request->pesan;
		$data->from = '0'; // dari dokter
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
