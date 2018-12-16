@extends('layouts.app')

@section('content')
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            <div class="text-center">
                <h5>
                    <i class="fas fa-pen"></i> Compose Announcement
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                {!! Form::open(['action' => 'AnnouncementController@store', 'method' => 'POST']) !!}
                <div class="col-md-5">
                    {{Form::hidden('id', $center->id)}}
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required'])}}
                </div>
                <div class="col-md-12">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Type your announcement...', 'required' => 'required'])}}
                </div>
                <br>
                <div class="row">
                    {{csrf_field()}}
                    <div class="col-md-12 text-center">
                        <a href="/home" role="button" class="btn btn-outline-danger">Cancel</a>
                        {{Form::submit('Submit', ['class'=>'btn btn-outline-success'])}}
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