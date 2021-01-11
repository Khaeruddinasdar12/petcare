

<!------ Include the above in your HEAD tag ---------->


<html>
<head>
  <title>MyPets | Chat Dokter</title>
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
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <h3 class=" text-center"><a href="{{ route('home') }}"><i class="fa fa-home"></i>| </a> <a href="{{route('tanya.dokter')}}">Lihat daftar Dokter</a>| Messaging  </h3>
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
            <div class="inbox_chat" id="list_dokter"> <!-- nav list dokter -->

            </div>
          </div>
          <div class="mesgs">
            <div class="msg_history" id="chat">
              
              
              
            </div>

            <div class="type_msg">
              <div class="input_msg_write">
                <form method="post" id="sendchat">
                  @csrf
                  <input type="hidden" name="dokter_id" id="to-dokter-id" >
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

    messaging.onMessage((payload) => { // akan otomatis tereksekusi jika sendchat(id)
      console.log('Message received. ');
      console.log(payload);

      // alert('hai');
      // location.reload();
      list_dokter();
      // alert(idDokter);
      chat(idDokter);  
    });
    
    var idAuth = '{!! Auth::user()->id !!}'; // yang sedang login

    var idDokter = '{!! $idDokter !!}'; // id dokter yang sedang di ajak chat

    $(document).ready(function(){ //menampilkan list dokter dan chat nya jika ada
      list_dokter();
      if(idDokter == 0) {

      } else {
        chat(idDokter);  
      }
      
    });

    $('#sendchat').submit(function (e) {
        e.preventDefault();
        var request = new FormData(this);
        var endpoint = '{{ route("user.createchat") }}';
        $.ajax({
            url: endpoint,
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                // idDokter = ;  

                $(".loader").css("display", "block");
            },
            // dataType: "json",
            success: function (data) {
                $('#sendchat')[0].reset(); //reset form chat
            },
            error: function (xhr, status, error) {
                var error = xhr.responseJSON;
                if ($.isEmptyObject(error) == false) {
                    $.each(error.errors, function (key, value) {
                        alert(value);
                    });
                }
            }
        });
    });
    
    function chat(id) { // memunculkan percakapan sesuai user yang terpilih atau terklik
      idDokter = id;
      list_dokter();
      $('#to-dokter-id').val(idDokter);
      // alert('chat function ' + id);
        var endpoint = "../../user/percakapan/"+id;
        // alert(endpoint);
        token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: endpoint,
            // method: "POST",
            contentType: false,
            cache: false,
            data : {
                    '_method' : 'POST',
                    '_token'  : token
                  },
            processData: false,
            beforeSend: function () {
                $(".loader").css("display", "block");
            },
            success: function (data) {
                // obj = data[0].chat;
                // console.log(obj);
                i = 1;
                var txt = [];
                $.each(data, function (key, value) {
                    if (value.from == 1) { // jika user
                      if(value.pesan == null) {
                        var psn = 'silakan mulai chat, Anda belum memiliki percakapan dengan dokter ini';
                        var wkt = '';
                      } else {
                        var psn = value.pesan;
                        var wkt = value.created_at;
                      }
                      txt[i] =' <div class="outgoing_msg"><div class="sent_msg"><p>'+psn+'</p><span class="time_date">'+wkt+' </span></div></div>';
                    } else { // jika dokter
                      txt[i] ='<div class="incoming_msg"><div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="received_msg"><div class="received_withd_msg"><p>'+value.pesan+'</p><span class="time_date"> '+value.created_at+' </span></div></div></div>';
                    }
                    
                    // data = 
                    // console.log(value.from);
                    i++;
                });
                // $("#nama-user").text(data[0].nama_kontak);
                $("#chat").html(txt.join([separator = '']));
                // console.log('' + id);
                // $(".loader").css("display", "none");
            },
            error: function (xhr, status, error) {
                var error = xhr.responseJSON;
                if ($.isEmptyObject(error) == false) {
                    $.each(error.errors, function (key, value) {
                        alert(key, value);
                    });
                }
            }
        });
    }

    function list_dokter() { // menampilkan list dokter yang pernah chat
      var endpoint = "{{route('user.list-dokter')}}";
      // alert(endpoint);
      $.ajax({
        url: endpoint,
        method: "GET",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          // alert('success');
          // obj = data[0].chat;
                // console.log(data);
                i = 1;
                var txt = [];
                $.each(data, function (key, value) {
                  if(value.dokter_id == idDokter) {
                    var css = 'active_chat';
                  } else {
                    var css = '';
                  }
                    txt[i] =
                    '<a onclick="chat('+value.dokter_id+')"><div class="chat_list '+css+'"><div class="chat_people"><div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="chat_ib"><h5>'+value.name+' <span class="chat_date">'+value.waktu+'</span></h5></div></div></div></a>';
                    i++;
                  });
                // $("#nama-user").text(data[0].nama_kontak); 
                $("#list_dokter").html(txt.join([separator = '']));
                // console.log('' + id);
                // $(".loader").css("display", "none");
              },
              error: function (xhr, status, error) {
                var error = xhr.responseJSON;
                if ($.isEmptyObject(error) == false) {
                  $.each(error.errors, function (key, value) {
                    alert(key, value);
                  });
                }
              }
            });
    }

</script>



</html>


