@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center">
                    <i class="fas fa-box-open"></i>
                    Donations to this Center
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="padding-bottom:15px">
                            <button type="button" class="btn btn-outline-primary btn-sm" href="#" data-target="#recordDonation" data-toggle="modal">
                                <i class="fa fa-pen"></i>
                                Record Donation
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm" id="dataTable">
                                <thead class="thead">
                                    <th>Date & Time Registered</th>
                                    <th>Operation Title</th>
                                    <th>Donor</th>
                                    <th>Status</th>
                                    <th>View</th>
                                </thead>
                                <tbody>
                                    @if(count($donations) > 0)
                                        @foreach($donations as $o)
                                            <tr>
                                                <td>{{$o->created_at}}</td>
                                                <td>{{$o->name}}</td>
                                                <td>{{$o->donor}}</td>
                                                <td>
                                                    @if($o->confirmation == "Encoding")
                                                        {{$o->confirmation}}
                                                    @else
                                                        Recorded
                                                    @endif
                                                </td>
                                                <td>
                                                    <a role="button" class="btn btn-outline-success btn-sm" href="/viewSelectedDonation/{{$o->id}}">
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
<div class="modal fade" id="recordDonation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Record Donation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => 'InventoryController@newDonation', 'method' => 'POST']) !!}
                {{Form::label('name', 'Operation Title')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Operation Title', 'required' => 'required'])}}  
                {{Form::label('donor', 'Donor')}}
                {{Form::text('donor', '', ['class' => 'form-control', 'placeholder' => 'Donor', 'required' => 'required'])}}  
            </div>
            <div class="modal-footer">
                {{csrf_field()}}
                <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                {{Form::submit('Submit', ['class'=>'btn btn-outline-success'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection