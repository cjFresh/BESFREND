@extends('layouts.chat')

@section('content')

    

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="text-center">
                    <i class="fa fa-comments"></i>
                        Emergency Chat
                    </h5>
                </div>
                <div class="card-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="card-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection