@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-address-card"></i> Status Report</h5></div>
            <div class="card-body">  
                <div class="table-responsive"> 
                @if(count($stats) > 0)  
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Name</th>
                            <th>Evacuated At</th>
                            <th>Whereabouts</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Time</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($stats as $s)
                                <tr>
                                    @if($s->evacuation->status == "Ongoing" && $s->household_member->house_id == Auth::user()->household->id)
                                    <td>{{$s->household_member->person->first_name}} {{$s->household_member->person->last_name}}</td>
                                    <td>
                                        @if($s->center_id != NULL)
                                            <p>{{$s->center->location}}</p>
                                        @else
                                            <small>Not in any evac centers</small>
                                        @endif
                                    </td>
                                    <td>{{$s->whereabouts}}</td>   
                                    <td>{{$s->status}}</td>
                                    <td>{{$s->remarks}}</td>  
                                    <td>{{$s->updated_at}}</td>
                                    <td>
                                        @if($s->whereabouts != "Missing")
                                            <a href="#" data-toggle="modal" data-target="#missing{{$s->id}}" role="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-user-times"></i></a>
                                            @if($s->status != "Injured/Sick")
                                                <a href="#" data-toggle="modal" data-target="#injured{{$s->id}}" role="button" class="btn btn-outline-dark btn-sm"><i class="fas fa-first-aid"></i></a> 
                                            @endif
                                        @else
                                            <a href="#" data-toggle="modal" data-target="#found{{$s->id}}" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-user-check"></i> Found</a>
                                        @endif
                                    </td>
                                    @endif
                                    <!-- Missing Modal-->
                                    <div class="modal fade" id="missing{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content border-danger">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Report {{$s->household_member->person->first_name}} {{$s->household_member->person->last_name}} as <strong>Missing</strong>
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['EvacuationController@missing', $s->id], 'method' => 'POST']) !!}  
                                                    {{Form::label('remarks', 'Remarks')}}
                                                    {{Form::text('remarks', $s->remarks, ['class' => ' form-control', 'placeholder' => 'Remarks', 'required' => 'required'])}}
                                                </div>
                                                <div class="modal-footer">
                                                        <div class="text-right">
                                                            <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>
                                                            {{csrf_field()}}
                                                            {{Form::submit('Report Missing', ['class'=>'btn btn-outline-danger'])}}
                                                            {!! Form::close() !!}
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Found Modal-->
                                    <div class="modal fade" id="found{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content border-success">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Report {{$s->household_member->person->first_name}} {{$s->household_member->person->last_name}} as <strong>Found</strong>
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['EvacuationController@found', $s->id], 'method' => 'POST']) !!}  
                                                    {{Form::label('status', 'Status')}}
                                                    {{Form::select('status', [
                                                                    'Fine' => 'Fine',
                                                                    'Injured/Sick' => 'Injured/Sick'],
                                                                    $s->status,
                                                                    ['class' => 'form-control']
                                                    )}}
                                                    {{Form::label('remarks', 'Remarks')}}
                                                    {{Form::text('remarks', $s->remarks, ['class' => ' form-control', 'placeholder' => 'Remarks', 'required' => 'required'])}}
                                                </div>
                                                <div class="modal-footer">
                                                     <div class="text-right">
                                                            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                            {{csrf_field()}}
                                                            {{Form::submit('Report Found', ['class'=>'btn btn-outline-success'])}}
                                                            {!! Form::close() !!}
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Injured Modal-->
                                    <div class="modal fade" id="injured{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content border-dark">
                                                <div class="modal-header bg-dark text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Report {{$s->household_member->person->first_name}} {{$s->household_member->person->last_name}} as <strong>Injured or Sick</strong>
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(['action' => ['EvacuationController@sick', $s->id], 'method' => 'POST']) !!}
                                                    {{Form::label('remarks', 'Remarks')}}
                                                    {{Form::text('remarks', $s->remarks, ['class' => ' form-control', 'placeholder' => 'Remarks', 'required' => 'required'])}}
                                                </div>
                                                <div class="modal-footer">
                                                     <div class="text-right">
                                                            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                            {{csrf_field()}}
                                                            {{Form::submit('Report Sick/Injured', ['class'=>'btn btn-outline-dark'])}}
                                                            {!! Form::close() !!}
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection