@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">Status Report of {{$stats->household_member->person->first_name}} {{$stats->household_member->person->last_name}}</h5></div>
            <div class="card-body">    
                {!! Form::open(['action' => ['StatusController@update', $stats->id], 'method' => 'POST']) !!}
            
                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('whereabouts', 'Whereabouts')}}
                        {{Form::select('whereabouts', [
                            'Found' => 'Found', 
                            'Missing' => 'Missing' ],
                            $stats->whereabouts,
                            ['class' => 'form-control']
                        )}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('status', 'Status')}}
                        {{Form::select('status', [
                            'Fine' => 'Fine', 
                            'Injured/Sick' => 'Injured/Sick', 
                            'Deceased' => 'Deceased',
                            'Unknown' => 'Unknown' ],
                            $stats->status,
                            ['class' => 'form-control']
                        )}}
                    </div>
                    <div class="col-md-4">
                            {{Form::label('remarks', 'Remarks')}}
                            {{Form::text('remarks', $stats->remarks, ['class' => 'form-control', 'placeholder' => 'Remarks'])}}
                        </div>
                    
                </div>

                <br>

                <div class="row justify-content-md-center">
                    {{csrf_field()}}
                        {{Form::submit('Update', ['class'=>'btn btn-outline-success'])}}

                        &nbsp &nbsp &nbsp <a role="button" class="btn btn-outline-danger" href="/status">Cancel</a>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection