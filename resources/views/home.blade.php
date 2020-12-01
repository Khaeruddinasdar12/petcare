@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">

    const messaging = firebase.messaging();
    messaging.usePublicVapidKey("BCC387mwd1QDLxXe5gk7gUOSSR7Me1qbU3ruD2FvY7z3MntJ0nmdYjNmWpl4qEPjgcYfE-rmmRoSLHHj2B982dU");

    function sendTokenToServer(token) {
        console.log('token retrieved ', token);
        user_id = '{{Auth::user()->id}}';
        axios.post('/api/save-token', {
            'token' : token, 
            'user_id' : user_id
        }).then(res => {
            console.log(res);
        }); 
    }

    messaging.getToken().then((currentToken) =>{
        if(currentToken) {
            sendTokenToServer(currentToken);
        } else {

        }
    }).catch((err) => {
        console.log('An error occured while retrieving token. ', err);
        // showToken('Error retrieving Instance ID token. ', err);
        // setTokenSentToServer(false);
    })

</script>

@endsection
