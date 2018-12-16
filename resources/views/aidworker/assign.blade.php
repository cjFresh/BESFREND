@extends('layouts.app')

@section('content')

<div class="row">     

    <div class="col-md-12">   
        <div class="card border-primary">    
          <div class="card-header bg-primary text-white"><h5 class="text-center">Assign Aid Workers for {{$assignthisfor->centers->location}}</h5></div>
          <div class="card-body">
                <a href="/manageAid" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                <br>
                <br>
                <div class="col-md-6">Number of staff Needed: {{$assignthisfor->num_staff_needed}}</div>
              </div>   
            <div class="card-body"> 
                    @php
                    $counter=0;   
                    foreach($availableAid as $ctr){
                        $counter++;        
                    }
                @endphp            
        @if($assignthisfor->num_staff_needed != 0)
                <div class="table-responsive">        
                @if(count($availableAid) > 0)
                <table class="table table-hover table-sm" id="dataTable">
                 <thead class="thead">
                   <th>Name</th>
                   <th>Field</th>
                   <th>Assigned Center</th>
                   <th>Action</th>
                 </thead>
            <tbody>
                 @foreach($availableAid as $aa)
                <tr>
                <td>{{$aa->aid_worker->person->first_name}} {{$aa->aid_worker->person->last_name}}</td>
                    <td>{{$aa->aid_worker->field}}</td>
                    @if($aa->center_id == Auth::user()->center->id)
                    <td>Command Center</td>
                    @endif
                    <td>
                    <input name="id" value="{{$id}}" type="hidden">
                    <a href="/assignThis/{{$id}}/{{$centerid->center_id}}/{{$aa->aid_worker_id}}" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-check"></i></a>    
                    </td>
                </tr>
                    @endforeach
              </tbody>
            </table>
            </div>
                @else 
                
                 There are no available aid workers right now 
                 {!! Form::open(['action' => ['AidController@approveaid', $assignthisfor->id], 'method' => 'POST']) !!}
                              <div class="col-md-12">
                                  {{Form::label('', '')}}
                                  {{Form::textarea('', '', ['class' => 'form-control', 'rows' => 5, 'cols' => 5, 'placeholder' => ''])}}     
                                 
                                  <style>
                                      textarea{
                                          resize: none;
                                      }
                                  </style>
                              </div>
                              
                              <br>

                           <div class="row justify-content-md-center">
                                {{csrf_field()}}
                                {{Form::submit('Submit', ['class'=>'btn btn-outline-success btn-sm'])}}
                              
                                {!! Form::close() !!}
                @endif
                @else
                Aid Workers that was requested by {{$assignthisfor->centers->location}} Evacuation Center 
                has been assigned!
                <a href="/manageAid" role="button" class="btn btn-outline-info btn-sm"><i class="fas fa-check"></i></a>
            @endif
            </div>    
        </div>    
    </div>
</div>
</div>
</div>
</div>

@endsection