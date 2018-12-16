@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
              <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-user-plus"></i> Aid Worker Registration</h5></div>
                <div class="card-body">
                    <h5>Required *</h5>
                    {!! Form::open(['action' => 'AidController@addaid', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                {{Form::label('first_name', 'First Name *')}}
                                {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
                            </div>
                            <div class="col-md-4">
                                {{Form::label('middle_name', 'Middle Name')}}
                                {{Form::text('middle_name', '', ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
                            </div>
                            <div class="col-md-4">
                                {{Form::label('last_name', 'Last Name *')}}
                                {{Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
                            </div>
                            <div class="col-md-4">
                                {{Form::label('gender', 'Gender *')}}
                                {{Form::select('gender', [
                                    'Male' => 'Male', 
                                    'Female' => 'Female'],
                                    "",
                                    ['class' => 'form-control', 'required' => 'required']
                                )}}
                            </div>   
                            <div class="col-md-4">
                                {{Form::label('birth_date', 'Date of Birth *')}}
                                {{Form::date('birth_date', date('d-M-y'), ['class' => 'form-control', 'required' => 'required'])}}
                            </div>
                            <div class="col-md-4">
                                {{Form::label('mobile_num', 'Mobile Number')}}
                                {{Form::text('mobile_num', '', ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '11', 'required' => 'required'])}}
                            </div>
                            <div class="col-md-4">
                                {{Form::label('email', 'Email')}}
                                {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
                            </div>
                            <div class="col-md-4">
                                {{Form::label('field', 'Field *')}}
                                {{Form::select('field', [
                                    'Rescue' => 'Rescue', 
                                    'Medical' => 'Medical',
                                    'Technical' =>'Technical',
                                    'Security' => 'Securitry',
                                    'Others' => 'Others'],
                                    "",
                                    ['class' => 'form-control']
                                )}}
                            </div>
                                
                                    <div class="col-md-4">
                                        {{Form::label('photo', 'Photo')}}
                                        {{Form::file('photo', ['class' => 'form-control'])}}
                            </div>
                        </div>

                        <br>
                        
                    <div class="col-md-12 text-center">
                            <a href="/home" role="button" class="btn btn-outline-danger">Cancel</a>
                            {{csrf_field()}}
                            {{Form::submit('Add', ['class'=>'btn btn-outline-primary'])}}
                            {!! Form::close() !!}
                    </div>
            </div>
        </div>            
    </div>
</div>
@endsection
