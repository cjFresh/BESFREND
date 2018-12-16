@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">Evacuation Center Information</h5></div>
            <div class="card-body">
                {!! Form::open(['action' => 'CenterController@store', 'method' => 'POST']) !!}
                  <h5>Account Details</h5>
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::label('username', 'Username')}}
                            {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username'])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('password', 'Password')}}
                            {{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password'))}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('confirm_password', 'Confirm Password')}}
                            {{Form::password('confirm_password', array('class' => 'form-control', 'placeholder' => 'Confirm Password'))}}
                        </div>
                    </div>

                    <br>

                  <h5>Evacuation Center Details</h5>  
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::label('accommodation', 'Accommodation')}}
                            {{Form::number('accommodation', '', ['class' => 'form-control', 'placeholder' => 'Accommodation'])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('location', 'Location')}}
                            {{Form::text('location', '', ['class' => 'form-control', 'placeholder' => 'Location'])}}
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    
                    <br>

                <div class="row justify-content-md-center">
                    {{csrf_field()}}
                        {{Form::submit('Register', ['class'=>'btn btn-outline-success'])}}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection