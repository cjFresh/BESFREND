@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">Aidworker Information of {{$aid->person->first_name}} {{$aid->person->last_name}}</h5></div>
            <div class="card-body">
                {!! Form::open(['action' => ['AidController@update', $aid->id], 'method' => 'POST']) !!}
  
                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('first_name', 'First Name')}}
                        {{Form::text('first_name', $aid->person->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('middle_name', 'Middle Name')}}
                        {{Form::text('middle_name', $aid->person->middle_name, ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('last_name', 'Last Name')}}
                        {{Form::text('last_name', $aid->person->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('gender', 'Gender')}}
                        {{Form::select('gender', [
                            'Male' => 'Male', 
                            'Female' => 'Female'],
                            $members->person->gender,
                            ['class' => 'form-control']
                        )}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('birth_date', 'Birth Date')}}
                        {{Form::date('birth_date', $aid->person->birth_date, ['class' => 'form-control', 'placeholder' => 'Birth Date', 'required' => 'required'])}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('mobile_num', 'Mobile Number')}}
                        {{Form::text('mobile_num', $aid->person->mobile_num, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '11', 'required' => 'required'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('email', 'Email')}}
                        {{Form::email('email', $aid->person->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
                    </div>
                    <div class="col-md-4">
                            {{Form::label('field', 'Field')}}
                            {{Form::select('field', [
                                'Rescue' => 'Rescue', 
                                'Medical' => 'Medical',
                                'Technical' => 'Technical',
                                'Security' => 'Security',
                                'Others' => 'Others' ],
                                $aid->field,
                                ['class' => 'form-control']
                            )}}
                    </div>
                </div>
                

                <br>
                
                    <div class="row justify-content-md-center">
                        {{csrf_field()}}
                            {{Form::submit('Update', ['class'=>'btn btn-outline-success'])}}

                            &nbsp &nbsp &nbsp <a role="button" class="btn btn-outline-danger" href="/viewAid">Cancel</a>
                            {!! Form::close() !!}
                    </div>
            </div>
        </div>
    </div>            
</div>
@endsection