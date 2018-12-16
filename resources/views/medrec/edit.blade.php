@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-file-medical-alt"></i> Update Medical Record</h5></div>
            <div class="card-body">
                    {!! Form::open(['action' => ['MedicalRecordController@update', $medical_backgrounds->id], 'method' => 'POST']) !!}
                
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::label('condition', 'Current Condition')}}
                            {{Form::text('condition', $medical_backgrounds->condition, ['class' => 'form-control', 'placeholder' => 'Current Condition', 'required' => 'required'])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('severity', 'Severity')}}
                            {{Form::select('severity', [
                                'Fully Recovered' => 'Fully Recovered', 
                                'Mild' => 'Mild',
                                'Severe' => 'Severe',
                                'Life-threatening' => 'Life-threatening' ],
                                $medical_backgrounds->severity,
                                ['class' => 'form-control', 'required' => 'required']
                            )}}
                        </div>
                        <div class="col-md-4">
                                {{Form::label('medication', 'Medication')}}
                                {{Form::text('medication', $medical_backgrounds->medication, ['class' => 'form-control', 'placeholder' => 'Medication', 'required' => 'required'])}}
                            </div>
                        
                    </div>

                    <br>

                    <div class="row justify-content-md-center">
                        <a role="button" class="btn btn-outline-danger" href="/view/{{$medical_backgrounds->household_member->id}}">Cancel</a>
                        &nbsp &nbsp

                        {{csrf_field()}}
                        {{Form::submit('Update', ['class'=>'btn btn-outline-success'])}}

                        {!! Form::close() !!}
                    </div>
            </div>
        </div>            
    </div>
    <div class="col-md-2"></div>
</div>
@endsection