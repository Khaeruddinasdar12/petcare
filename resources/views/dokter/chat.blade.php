

<!------ Include the above in your HEAD tag ---------->


<html>
<head>
  <title>MyPets | Chat Reply User</title>
  <link href="{{asset('chat/font-awesome/css/font-awesome.css')}}" type="text/css" rel="stylesheet">
  <!-- <script src="{{asset('chat/js/jquery.min.js')}}"></script> -->
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
  <link href="{{asset('chat/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
  <script src="{{asset('chat/js/bootstrap.min.js')}}"></script>

  <link rel="stylesheet" type="text/css" href="{{asset('chat/css/style.css')}}">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
 https://firebase.google.com/docs/web/setup#available-libraries -->
 <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-auth.js"></script>
 <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-firestore.js"></script>
 <!-- <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-analytics.js"></script> -->

 <script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyAXMFabSnctaDDAABRSuxPKxIhiTW22qNI",
    authDomain: "petcare-8fdde.firebaseapp.com",
    projectId: "petcare-8fdde",
    storageBucket: "petcare-8fdde.appspot.com",
    messagingSenderId: "189745989695",
    appId: "1:189745989695:web:d6841b38fbcd6e8f33508a",
    measurementId: "G-FBG1DW8XD1"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  // firebase.analytics();
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body>
  <div class="container">
    <h3 class=" text-center"><a href="{{ route('home') }}"><i class="fa fa-home"></i> </a>Messaging  </h3>
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
            <div class="inbox_chat" id="list_user"> <!-- nav list user -->

            </div>
          </div>
          <div class="mesgs">
            <div class="msg_history" id="chat">



            </div>

            <div class="type_msg">
              <div class="input_msg_write">
                <form method="post" id="sendchat">
                  @csrf
                  <input type="hidden" name="user_id" id="to-user-id" >
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
    messaging.usePublicVapidKey("BFYb7ygeQK62Rd-QINuJTmf9NF-6QXXi6jnm0sU_YpC_RIDq4X3Y-q7tQHAB5LnGeR0s_naaDafbXuI1veqQmtI");

    function sendTokenToServer(token) {
      console.log('token dokter retrieved ', token);
      user_id = '{{Auth::guard("dokter")->user()->id}}';
      url = '{{route("save.tokenDokter")}}';
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

      alert('hei dokter');
      list_user();
      // alert(idDokter);
      chat(idUser); 

      // alert('hai');
      // location.reload();
    });

    var idUser = 0;

    $(document).ready(function(){ //menampilkan list dokter dan chat nya jika ada
      list_user();
    });

    $('#sendchat').submit(function (e) {
      e.preventDefault();
      idUser = $('#to-user-id').val();
      list_user();
      var request = new FormData(this);
      var endpoint = "{{route('dokter.createchat')}}";
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
      idUser = id;
      // list_user();
      $('#to-user-id').val(idUser);
      // alert('chat function ' + id);
      var endpoint = "percakapan/"+id;
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
                    if (value.from == 0) { // jika dokter
                      txt[i] =' <div class="outgoing_msg"><div class="sent_msg"><p>'+value.pesan+'</p><span class="time_date">'+value.created_at+' </span></div></div>';
                    } else { // jika user
                      if(value.pesan == null) {
                        var psn = 'Pengguna ini membuka portal chat dengan Anda, hubungi jika diperlukan. *ini hanya pemberitahuan, pengguna belum menghubungi Anda. ';
                        var wkt = '';
                      } else {
                        var psn = value.pesan;
                        var wkt = value.created_at;
                      }
                      txt[i] ='<div class="incoming_msg"><div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="received_msg"><div class="received_withd_msg"><p>'+psn+'</p><span class="time_date"> '+wkt+' </span></div></div></div>';
                    }

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

    function list_user() { // menampilkan list dokter yang pernah chat
      var endpoint = "{{route('dokter.list-user')}}";
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
                  if(value.user_id == idUser) {
                    var css = 'active_chat';
                  } else {
                    var css = '';
                  }
                  txt[i] =
                  '<a onclick="chat('+value.user_id+')"><div class="chat_list '+css+'"><div class="chat_people"><div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="chat_ib"><h5>'+value.name+' <span class="chat_date">'+value.waktu+'</span></h5></div></div></div></a>';
                  i++;
                });
                // $("#nama-user").text(data[0].nama_kontak); 
                $("#list_user").html(txt.join([separator = '']));
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


