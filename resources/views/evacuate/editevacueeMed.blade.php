@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">Update Medical Record</h5></div>
            <div class="card-body">
                    {!! Form::open(['action' => ['EvacuationController@updateMed', $medical_backgrounds->id], 'method' => 'POST']) !!}
                
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::label('condition', 'Current Condition')}}
                            {{Form::text('condition', $medical_backgrounds->condition, ['class' => 'form-control', 'placeholder' => 'Current Condition'])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::hidden('evac_id', $evac_id)}}
                            {{Form::label('severity', 'Severity')}}
                            {{Form::select('severity', [
                                'Fully Recovered' => 'Fully Recovered', 
                                'Mild' => 'Mild',
                                'Severe' => 'Severe',
                                'Life-threatening' => 'Life-threatening' ],
                                $medical_backgrounds->severity,
                                ['class' => 'form-control']
                            )}}
                        </div>
                        <div class="col-md-4">
                                {{Form::label('medication', 'Medication')}}
                                {{Form::text('medication', $medical_backgrounds->medication, ['class' => 'form-control', 'placeholder' => 'Medication'])}}
                            </div>
                        
                    </div>

                    <br>

                    <div class="row justify-content-md-center">
                        {{csrf_field()}}
                        {{Form::submit('Update', ['class'=>'btn btn-outline-success'])}}                    
                    &nbsp &nbsp &nbsp <a role="button" class="btn btn-outline-danger" href="/evacueeEdit/{{$evac_id}}">Cancel</a>
                        {!! Form::close() !!}
                    </div>
            </div>
        </div>            
    </div>
</div>
@endsection