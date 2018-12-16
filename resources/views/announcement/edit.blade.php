@extends('layouts.app')

@section('content')
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            <div class="text-center">
                <h5>
                    <i class="fas fa-pen"></i> Edit Announcement
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                {!! Form::open(['action' => ['AnnouncementController@update', $announce->id], 'method' => 'POST']) !!}
                <div class="col-md-5">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', $announce->title, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required'])}}
                </div>
                <div class="col-md-12">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', $announce->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Type your announcement...', 'required' => 'required'])}}
                </div>
                </br>
                <div class="row">
                    {{csrf_field()}}
                    <div class="col-md-12 text-center">
                        <a role="button" class="btn btn-outline-danger" href="/home">Cancel</a>
                        {{Form::submit('Update', ['class'=>'btn btn-outline-success'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div> 
        
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
    </div>
@endsection