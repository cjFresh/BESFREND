@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card border-primary ">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center">Item Request Form</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h6><strong>Date Requested: {{$request->created_at}}</strong></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><strong>Requested By: {{$request->user->username}}</strong></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><strong>Reason: {{$request->reasons}}</strong></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><strong>Status: {{$request->status}}</strong></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            {!! Form::open(['action' => ['ReliefController@cmdRequestApproval', $request->id], 'method' => 'POST']) !!}  
                            <h5 class="text-center"><i class="fa fa-check"></i> Approval Verdict</h5>
                            {{Form::radio('choice', 'Approved', true)}}
                            {{Form::label('choice', 'Approve')}}
                            <br>
                            {{Form::radio('choice', 'Denied')}}
                            {{Form::label('choice', 'Decline')}}
                            <br>
                            {{Form::label('remarks', 'Remarks')}}
                            {{Form::textarea('remarks', '', ['class' => ' form-control', 'placeholder' => 'Remarks', 'style' => 'resize:none;height:100px;', 'required' => 'required'])}}
                            {{csrf_field()}}
                            <br>
                            <div class="col-md-12 text-center">
                            <a href="/cmdViewItemRequests" role="button" class="btn btn-outline-danger">Cancel</a>    
                            {{Form::submit('Submit', ['class'=>'btn btn-outline-success'])}}
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <div class="table-responsive">
                <h5 class="text-center"><i class="fa fa-table"></i> Table of Items Requested</h5>    
                <table class="table table-hover table-sm" id="dataTable">
                    <thead class="thead">
                        <th>Item</th>
                        <th>Quantity Requested</th>
                        <th>Priority</th>
                    </thead>
                    <tbody> 
                        @foreach($request->item_request_lists as $list)
                            <tr>
                                <td>{{$list->item->name}}</td>
                                <td>{{$list->qty_requested}} {{$list->item->unit_measurement}}</td>
                                <td>{{$list->priority_level}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>        
        </div>
    </div>
</div>

@endsection