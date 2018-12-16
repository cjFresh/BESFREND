@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-file-medical"></i> Add Medical Record for {{$member->person->first_name}} {{$member->person->last_name}}</h5></div>
            <div class="card-body">
                {!! Form::open(['action' => 'MedicalRecordController@store', 'method' => 'POST']) !!}

                <div class="row">
                        <div class="col-md-4">
                            {{Form::hidden('id', $member->id)}}
                            {{Form::label('condition', 'Condition')}}
                            {{Form::text('condition', '', ['class' => 'form-control', 'placeholder' => 'Condition', 'required' => 'required'])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('severity', 'Severity')}}
                            {{Form::select('severity', [
                                'Fully Recovered' => 'Fully Recovered', 
                                'Mild' => 'Mild',
                                'Severe' => 'Severe',
                                'Life-threatening' => 'Life-threatening' ],
                                '',
                                ['class' => 'form-control', 'required' => 'required']
                                    )}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('medication', 'Medication')}}
                            {{Form::text('medication', '', ['class' => 'form-control', 'placeholder' => 'Medication', 'required' => 'required'])}}
                        </div>
                </div>

                <br>

                <div class="row justify-content-md-center">
                    <a href="/view/{{$member->id}}" role="button" class="btn btn-outline-danger">Cancel</a>  
                    &nbsp &nbsp 
                    {{csrf_field()}}
                    {{Form::submit('Add', ['class'=>'btn btn-outline-primary'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
@endsection