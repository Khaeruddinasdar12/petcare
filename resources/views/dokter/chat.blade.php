

<!------ Include the above in your HEAD tag ---------->


<html>
<head>
  <title>MyPets | Chat</title>
  <link href="{{asset('chat/font-awesome/css/font-awesome.css')}}" type="text/css" rel="stylesheet">
  <!-- <script src="{{asset('chat/js/jquery.min.js')}}"></script> -->
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
  <link href="{{asset('chat/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
  <script src="{{asset('chat/js/bootstrap.min.js')}}"></script>

  <link rel="stylesheet" type="text/css" href="{{asset('chat/css/style.css')}}">
  <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-messaging.js"></script>
  <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
  <!-- <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-analytics.js"></script> -->

  <!-- Add Firebase products that you want to use -->
  <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-firestore.js"></script>

  <script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyAlMslEpJ8rSkaA8648H0ySkis-668E-P0",
    authDomain: "chat-b1584.firebaseapp.com",
    databaseURL: "https://chat-b1584.firebaseio.com",
    projectId: "chat-b1584",
    storageBucket: "chat-b1584.appspot.com",
    messagingSenderId: "375668871045",
    appId: "1:375668871045:web:f0e8da12520d4d8e84beec",
    measurementId: "G-5GDV77GLYH"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  // firebase.analytics();
  // const messaging = firebase.messaging();
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body>
  <div class="container">
    <h3 class=" text-center"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a> Messaging</h3>
    <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Pesan terbaru</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Cari" >
                <span class="input-group-addon">
                  <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
              </div>
            </div>
            <div class="inbox_chat">
              @foreach($user as $usr)
              <div class="chat_list active_chat">
                <div class="chat_people">
                  <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                  <div class="chat_ib">
                    <h5>{{$usr->name}} <span class="chat_date">{{$usr->waktu}}</span></h5>
                    <p>Test, which is a new approach to have all solutions 
                    astrology under one roof.</p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="mesgs">
            <div class="msg_history">
              @foreach($chat as $chats)
              @if($chats->from == '0') 
              <!-- Jika dokter -->
              <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p>{{$chats->pesan}}</p>
                    <span class="time_date"> {{$chats->created_at}} </span>
                  </div>
                </div>
              </div>
              @else
              <!-- Jika yang sedang login -->
              <div class="outgoing_msg">
                <div class="sent_msg">
                  <p>{{$chats->pesan}}</p>
                  <span class="time_date"> {{$chats->created_at}} </span>
                </div>
              </div>
              @endif
              @endforeach
              
              
            </div>

            <div class="type_msg">
              <div class="input_msg_write">
                <form action="{{route('user.createchat')}}" method="post">
                  @csrf
                  <input type="hidden" name="dokter_id" value="1">
                  <input type="text" class="write_msg" placeholder="Type a message" name="pesan" autocomplete="off" />
                  <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </body>


  <script type="text/javascript">

    const messaging = firebase.messaging();
    messaging.usePublicVapidKey("BCC387mwd1QDLxXe5gk7gUOSSR7Me1qbU3ruD2FvY7z3MntJ0nmdYjNmWpl4qEPjgcYfE-rmmRoSLHHj2B982dU");

    function sendTokenToServer(token) {
      console.log('token retrieved ', token);
      user_id = '{{Auth::user()->id}}';
      url = '{{route("save.token")}}';
      axios.post(url , {
        'token' : token, 
        'user_id' : user_id
      }).then(res => {
        console.log(res);
      }); 
    }

    function retrieveToken() {
      messaging.getToken().then((currentToken) =>{
        if(currentToken) {
          sendTokenToServer(currentToken);
        } else {
          alert('you should allow notification');
        }
      }).catch((err) => {
        console.log('An error occured while retrieving token. ', err);
        // showToken('Error retrieving Instance ID token. ', err);
        // setTokenSentToServer(false);
      })
    }

    retrieveToken();
  
    messaging.onTokenRefresh(() => {
      retrieveToken();
    });

    messaging.onMessage((payload) => {
      console.log('Message received. ');
      console.log(payload);
      alert('halaman dokter');
      location.reload();
    });
    

  </script>



  </html>


