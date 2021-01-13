<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Chat;
use App\Dokter;
use DB;

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


	public function indexGet()
	{
		// $token = Dokter::all()->pluck('fcm_token')->toArray();
		// $token2 = User::all()->pluck('fcm_token')->toArray();
		// $mergeToken = array_merge($token, $token2);
		// return $mergeToken;
		return view('chat-user.index', ['idDokter' => 0]);
	}

	public function indexPost(Request $request) 
	{
		$auth_id = Auth::user()->id; // user yang sedang login
		$cek = Chat::where('user_id', $auth_id)->where('dokter_id', $request->idDokter)->count(); // cek jika pernah chat sebelumnya atau belum

		if($cek == 0) {
			$chat = new Chat; // menginput ke chat
			$chat->user_id = $auth_id;
			$chat->dokter_id = $request->idDokter;
			$chat->from = '1'; // dari user
			$chat->save();
		} else {
			$cek = Chat::where('user_id', $auth_id)->where('dokter_id', $request->idDokter)->whereNotNull('pesan')->count(); //jika pernah menekan sebelumnya
			if($cek == 1) {
				$del = Chat::where('user_id', $auth_id)
				->where('dokter_id', $request->idDokter)
				->whereNull('pesan')
				->delete();
			}
		}

		

		return view('chat-user.index', ['idDokter' => $request->idDokter]);

	}

	public function percakapan($id)
	{
		$auth_id = Auth::user()->id;
		$chat = Chat::where('user_id', $auth_id)->where('dokter_id', $id)->get();

		return $chat;
	}

	public function listdokter() //list dokter navside
	{
		$auth_id = Auth::user()->id; // user yang sedang login

		//dokter yang pernah chat dengan user
		$dokter = DB::select(DB::raw("select distinct chats.dokter_id, max(chats.created_at) as waktu, dokters.name from chats join dokters on chats.dokter_id = dokters.id where chats.user_id = $auth_id group by chats.dokter_id, dokters.name  order by max(chats.created_at) desc, chats.dokter_id"));
		
		return $dokter;
	}

	public function store(Request $request)
	{
		$validasi = $this->validate($request, [
			'pesan'     => 'required|string'
		]);

		$data = new Chat;
		$data->user_id = Auth::user()->id;
		$data->dokter_id = $request->dokter_id;
		$data->pesan = $request->pesan;
		$data->from = '1'; //dari user
		$data->save();

		$this->broadcast(Auth::user()->name, $request->pesan, $request->dokter_id);

		return $arrayName = array('status' => 'success' , 'pesan' => 'Berhasil Menambah Data', 'idDokter' => $request->dokter_id );  	
	}

	private function broadcast($senderName, $message, $idDokter)
	{
		// $rute = 
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

		// $token = Dokter::all()->pluck('fcm_token')->toArray();
		$token = Dokter::all()->pluck('fcm_token')->toArray();
		$token2 = User::all()->pluck('fcm_token')->toArray();
		$mergeToken = array_merge($token, $token2);
		// return $merge;
		$downstreamResponse = FCM::sendTo($mergeToken, $option, $notification, $data);

		return $downstreamResponse->numberSuccess();;
	}
}
