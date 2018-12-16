@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center">
                        <i class="fas fa-clipboard-check"></i>
                        Relief Operations
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="padding-bottom:15px">
                                <button type="button" class="btn btn-outline-primary btn-sm" href="#" data-target="#newOperation" data-toggle="modal">
                                    <i class="fa fa-plus"></i>
                                    Register Relief Operation
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-sm" id="dataTable">
                                    <thead class="thead">
                                        <th>Date & Time Registered</th>
                                        <th>Operation</th>
                                        <th>Destination</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </thead>
                                    <tbody>
                                        @if(count($ops) > 0)
                                            @foreach($ops as $o)
                                                <tr>
                                                    <td>{{$o->created_at}}</td>
                                                    <td>{{$o->name}}</td>
                                                    <td>{{$o->center->location}}</td>
                                                    <td>{{$o->confirmation}}</td>
                                                    <td>
                                                        <a role="button" class="btn btn-outline-success btn-sm" href="/viewReliefOperation/{{$o->id}}">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal-->
    <div class="modal fade" id="newOperation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-primary">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Register New Operation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'ReliefController@newReliefOperation', 'method' => 'POST']) !!}
                    {{Form::label('name', 'Name of Operation')}}
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required'])}}  
                    {{Form::label('dest_center_id', 'Destination Center')}}
                    <select class="form-control" name="dest_center_id">
                        <?php 
                            $centers = App\Center::whereHas('user', function ($query){
                                $query->where('user_type', 'Evacuation Center Account');
                            })
                            ->where('brgy_id', Auth::user()->center->brgy_id)
                            ->where('id', '<>', Auth::user()->center->id)
                            ->get();
                            //result ani nga query way labot ang Command Center
                            foreach($centers as $c){
                        ?>
                            <option value="{{$c->id}}">{{$c->location}}</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    {{csrf_field()}}
                    <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                    {{Form::submit('Register', ['class'=>'btn btn-outline-success'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection