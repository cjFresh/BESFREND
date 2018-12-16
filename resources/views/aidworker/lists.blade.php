@extends('layouts.app')

@section('content')

<div class="row">  
    <div class="col-md-12">   
        <div class="card border-primary">    
        <div class="card-header bg-primary text-white"><h5 class="text-center">Request Information of {{$requestlist->centers->location}}</h5></div>
            <div class="card-body">
                    <a href="/manageAid" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    <br>
                    <br>
              <div class="col-md-6">Number of staff Needed: {{$requestlist->num_staff_needed}}</div>
              <div class="col-md-6">Reason: {{$requestlist->reasons}}</div>
            </div>   
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                           {!! Form::open(['action' => ['AidController@approveaid', $requestlist->id], 'method' => 'POST']) !!}
                              <div class="col-md-12">
                                  {{Form::label('final_remarks', 'Final Remarks')}}
                                  {{Form::textarea('final_remarks', '', ['class' => 'form-control', 'rows' => 5, 'cols' => 5, 'placeholder' => 'Final Remarks'])}}     
                                 
                                  <style>
                                      textarea{
                                          resize: none;
                                      }
                                  </style>
                              </div>
                              
                              <br>

                           <div class="row justify-content-md-center">
                                {{csrf_field()}}
                                {{Form::submit('Approve', ['class'=>'btn btn-outline-success'])}}
                                {{Form::hidden('center_id', $centerid->center_id)}}
                                {!! Form::close() !!}
                           </div>
                        </div>   
                    </div>
                </div>   
        </div>    
    </div>
</div>
@endsection