@extends('layouts.app')

@section('content')
<style type="text/css">
    .chat-container {
        display: flex;
        flex-direction: column;
    }
    .chat {
        border: 1px solid gray;
        border-radius: 3px;
        width: 50%;
        padding: 0.5em;
    }

    .chat-left {
        background-color: white;
        align-self: flex-start;
    }

    .chat-right {
        background-color: #adff2f7f;
        align-self: flex-end;
    }

    .message-input-container {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: white;
        border: 1px solid gray;
        padding: 1em;

    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat</div>

                <div class="card-body">
                    <div class="chat-container">
                        <p class="chat chat-left">
                            <b>rasya : </b><br>
                            chat kiri
                        </p>
                        <p class="chat chat-right">
                            chat kanan
                        </p>
                        <p class="chat chat-right">
                            chat kanan
                        </p>
                        <p class="chat chat-left">
                            chat kiri
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="message-input-container">
    <form>
        <div class="form-group">
            <label>Pesan</label>
            <input type="text" name="" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
        
    </form>
</div>
@endsection

