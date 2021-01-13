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

	public function index() 
	{
		// $auth_id = Auth::guard('dokter')->user()->id; //id dokter sedang login
		// $name = Auth::guard('dokter')->user()->name;
		// return $name;
		return view('dokter.chat');

		$chat = Chat::where('user_id', $id)->where('dokter_id', $auth_id)->get();
		// return $chat;
		return view('dokter.chat', ['chat' => $chat]);
	}

	public function listuser() //list user navside
	{
		$auth_id = Auth::guard('dokter')->user()->id; //id dokter sedang login

		//user yang pernah chat dengan dokter
		$user = DB::select(DB::raw("select distinct chats.user_id, max(chats.created_at) as waktu, users.name from chats join users on chats.user_id = users.id where chats.dokter_id = $auth_id group by chats.user_id, users.name  order by max(chats.created_at) desc, chats.user_id"));
		
		return $user;
	}

	public function store(Request $request)
	{
		$validasi = $this->validate($request, [
            'pesan'     => 'required|string'
        ]);
		$data = new Chat;
		$data->user_id = $request->user_id;
		$data->dokter_id = Auth::guard('dokter')->user()->id;
		$data->pesan = $request->pesan;
		$data->from = '0'; //dari dokter
		$data->save();

		$this->broadcast(Auth::guard('dokter')->user()->name, $request->pesan, $request->user_id);

		return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menambah Data', 'idDokter' => $request->user_id );  	
	}

	public function percakapan($id)
	{
		$auth_id = Auth::guard('dokter')->user()->id; //id dokter sedang login

		$chat = Chat::where('user_id', $id)->where('dokter_id', $auth_id)->get();

		return $chat;
	}

	private function broadcast($senderName, $message, $idUser)
	{
		// $rute = 
		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(60*20);

		$notificationBuilder = new PayloadNotificationBuilder('Pesan dari :'. $senderName);
		$notificationBuilder->setBody($message)
		->setSound('default')
		->setClickAction('http://localhost:8000/tanya-dokter/chat');

		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData([
			'sender_name' => $senderName,
			'message' => $message
		]);

		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();

		// $token = User::all()->pluck('fcm_token')->toArray();
		$token = Dokter::all()->pluck('fcm_token')->toArray();
		$token2 = User::all()->pluck('fcm_token')->toArray();
		$mergeToken = array_merge($token, $token2);
		$downstreamResponse = FCM::sendTo($mergeToken, $option, $notification, $data);

		return $downstreamResponse->numberSuccess();;
	}
}
