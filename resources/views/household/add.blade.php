@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-user-plus"></i> Add Household Member</h5></div>
            <div class="card-body">
                {!! Form::open(['action' => 'HouseholdController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <h4>Registrant's Information</h4>
                <br>
                <h5>Required *</h5>
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
                            {{Form::label('mobile_num', 'Mobile Number *')}}
                       
                            <div class="row">
                              <div class="col-sm-3">
                                {{Form::text('', '', ['class' => 'form-control', 'placeholder' => '+63' ,'value' => '+63' , 'readonly','color' => 'black'])}}
                              </div>
                              <div class="col-sm-9">
                              {{Form::text('mobile_num', '', ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '10', 'required' => 'required'])}}
                              </div>  
                            </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('email', 'Email')}}
                        {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('heirarchy', 'Heirarchy *')}}
                        {{Form::select('heirarchy', [
                            'Not Applicable' => 'Not Applicable',
                            'Parent' => 'Parent', 
                            'Child' => 'Child',
                            'Relative' => 'Relative',
                            "Roommate" => "Roommate"],
                            "",
                            ['class' => 'form-control', 'required' => 'required']
                        )}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('other_address', 'Other Address (leave blank if none)')}}
                        {{Form::text('other_address', '', ['class' => 'form-control', 'placeholder' => 'Other Address'])}}
                    </div>
                    <div class="col-md-12">
                        <div class="row justify-content-md-center">        
                            <div class="col-md-4">
                                {{Form::label('photo', 'Photo')}}
                                {{Form::file('photo', ['class' => 'form-control'])}}
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-12 text-center">
                    {{csrf_field()}}
                    <a href="/home" class="btn btn-outline-danger" role="button">Cancel</a>
                    {{Form::submit('Submit', ['class'=>'btn btn-outline-success'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
