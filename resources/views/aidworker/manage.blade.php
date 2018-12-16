@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">   
        <div class="card border-primary">    
          <div class="card-header bg-primary text-white"><h5 class="text-center">Manage Aid Requests</h5></div>
            <div class="card-body">
                <div class="table-responsive">  
                @if(count($aidRequests) > 0)  
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Center</th>
                            <th>Number of Staff Needed</th>
                            <th>Reasons</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                            <tbody>
                                @foreach($aidRequests as $a)
                                    <tr>
                                        <td>{{$a->centers->location}}</td>
                                        <td>{{$a->num_staff_needed}}</td>
                                        <td>{{$a->reasons}}</td>
                                        <td>{{$a->status}}</td>
                                        @if($a->status == 'Denied')
                                    <td><a href="#" role="button" data-toggle="modal" data-target="#viewAidReq{{$a->id}}" class="btn btn-outline-success btn-sm"><i class="far fa-eye"></i></a>    </td>
                                        @elseif($a->status == 'Pending')
                                        <td>
                                        <a href="#" role="button" data-toggle="modal" data-target="#approveAid{{$a->id}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-check"></i></a>    
                                        <a href="#" role="button" data-toggle="modal" data-target="#deniedAid{{$a->id}}" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>                                        
                                        </td>
                                        @elseif($a->status == 'Approved')
                                        <td>
                                                <a href="/approveaid/{{$a->id}}" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-user-check"></i></a>    
                                        </td>
                                        </tr>
                                        @endif
                                        <!-- Approve Modal-->
    <div class="modal fade" id="approveAid{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-primary">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Request Information of {{$a->centers->location}}
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">  
                                      <div class="col-md-12">Number of staff Needed: {{$a->num_staff_needed}}</div>
                                      <div class="col-md-12">Reason: {{$a->reasons}}</div>
                                      <br>
                                      <br>
                        {!! Form::open(['action' => ['AidController@approveaid', $a->id], 'method' => 'POST']) !!}
                                      <div class="col-md-12">
                                          {{Form::label('final_remarks', 'Final Remarks')}}
                                          {{Form::textarea('final_remarks', '', ['class' => 'form-control', 'rows' => 5, 'cols' => 5, 'placeholder' => 'Final Remarks'])}}     
                                         
                                          <style>
                                              textarea{
                                                  resize: none;
                                              }
                                          </style>
                                      </div>
                </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-right">
                                    {{csrf_field()}}
                                    {{Form::submit('Approve', ['class'=>'btn btn-outline-success'])}}
                                    {{Form::hidden('center_id', $a->center_id)}}
                                    {!! Form::close() !!}
                                    <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deny Modal-->
<div class="modal fade" id="deniedAid{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    Deny Aid Request?
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => ['AidController@denyAid', $a->id], 'method' => 'POST']) !!}
                              <div class="col-md-12">
                                  {{Form::label('final_remarks', 'Final Remarks')}}
                                  {{Form::textarea('final_remarks', '', ['class' => 'form-control', 'rows' => 5, 'cols' => 5, 'placeholder' => 'Final Remarks'])}}     
                                 
                                  <style>
                                      textarea{
                                          resize: none;
                                      }
                                  </style>
                              </div>
                           
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-right">
                    <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>
                                {{csrf_field()}}
                                {{Form::submit('Deny', ['class'=>'btn btn-outline-danger'])}}
                                {{Form::hidden('center_id', $a->center_id)}}
                                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- View Denied Remarks Modal-->
<div class="modal fade" id="viewAidReq{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-success">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    Denied Request Details
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                  <h5>{{$a->final_remarks}}</h5>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-right">
                    <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
                                @endforeach
                            </tbody>
                    </table>
                @endif
                </div>
            </div>    
        </div>    
    </div>
</div>

<br>
<div class="row">        
        <div class="col-md-12">   
            <div class="card border-info">    
              <div class="card-header bg-info text-white"><h5 class="text-center">En Route Aidworkers</h5></div>
                <div class="card-body">
                    <div class="table-responsive">  
                    @if(count($aidworkerEnRoute) > 0)  
                        <table class="table table-hover table-sm" id="dataTable">
                            <thead class="thead">
                                <th>Center</th>
                                <th>Destination</th>
                                <th>Status</th>
                            </thead>
                                <tbody>
                                    @foreach($aidworkerEnRoute as $aw)
                                        <tr>
                                            <td>{{$aw->aid_worker->person->first_name}} {{$aw->aid_worker->person->middle_name}} {{$aw->aid_worker->person->last_name}}</td>
                                            <td>{{$aw->center->location}}</td>
                                            <td>{{$aw->status}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table> 
                        @else 
                        <h5>There are no currently En Route Aidworker</h5>
                    @endif
                    </div>
                </div>    
            </div>    
        </div>
    </div>
@endsection