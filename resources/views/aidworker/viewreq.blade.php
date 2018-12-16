@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">   
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="far fa-list-alt"></i> List of Requests</h5></div>
            <div class="card-body">
                <div class="col-md-12" style="padding-bottom: 15px;">
                    <div class="row">
                        <a href="#" role="button" data-toggle="modal" data-target="#newRequest" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Create New Request
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Center Requested</th>
                            <th>Staff Needed</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </thead>
                            <tbody>
                                @foreach($aidreq as $a)
                                    <tr>
                                         <td>{{$a->centers->location}}</td>
                                         <td>{{$a->num_staff_needed}}</td>
                                         <td>{{$a->reasons}}</td>
                                         <td>{{$a->status}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>    
    </div>
</div>

<!-- Add Modal-->
<div class="modal fade" id="newRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    Create New Worker Request
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => 'AidController@requestAid', 'method' => 'POST']) !!}  
                {{ Form::hidden('center_id', Auth::user()->center->id) }}
                {{Form::label('num_staff_needed', 'Staff Needed')}}
                {{Form::number('num_staff_needed', '', ['min' => 1, 'class' => 'form-control', 'placeholder' => 'Staff Needed', 'required' => 'required'])}}
                {{Form::label('reasons', 'Reasons')}}
                {{Form::text('reasons', '', ['class' => 'form-control', 'placeholder' => 'Reasons', 'required' => 'required'])}}
                {{ Form::hidden('status', 'Pending') }}
                
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-right">
                    <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                    {{csrf_field()}}
                    {{Form::submit('Submit Request', ['class'=>'btn btn-outline-success'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection