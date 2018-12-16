@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => 'ReliefController@requestForm', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center"><i class="fas fa-clipboard-list"></i> List of Requests</h5>
                </div>
                <div class="card-body">
                    <a href="#" role="button" data-toggle="modal" data-target="#newRequest" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Create New Request
                    </a>
                    </br>
                    </br>
                    @if(count($request) > 0)
                    <div class="table-responsive">
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Date</th>
                            <th>Reasons</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody> 
                            <tr>
                             @foreach($request as $r)
                                <td>{{$r->created_at}}</td>
                                <td>{{$r->reasons}}</td>
                                <td>{{$r->status}}</td>
                                <td>
                                    <a href="/ViewRequestItemsForm/{{$r->id}}" role="button" class="btn btn-outline-success btn-sm">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </td>
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

    <!-- Request Modal-->
    <div class="modal fade" id="newRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-primary">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Request</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'ReliefController@requestForm', 'method' => 'POST']) !!}
                    {{Form::label('reason', 'Reason')}}
                    {{Form::text('reason', '', ['class' => 'form-control', 'placeholder' => 'Reason'])}}                    
                </div>
                <div class="modal-footer">
                    {{csrf_field()}}
                    <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                    {{Form::submit('Confirm Request', ['class'=>'btn btn-outline-success'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
