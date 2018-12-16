@extends('layouts.app')

@section('content')
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-user"></i> Evacuee Information</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    <a href="/evacuateHere" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <img style="height:200px;width:200px;" class="mx-auto d-block img-thumbnail rounded-circle" src="/storage/uploads/{{$evacs->household_member->person->photo}}" alt="{{$evacs->household_member->person->first_name}} {{$evacs->household_member->person->last_name}}">
                        </div>
                    </div>
                    <div class="col-md-4"> 
                        <div class="text-left">   
                            <h6>Full Name: {{$evacs->household_member->person->first_name}} {{$evacs->household_member->person->middle_name}} {{$evacs->household_member->person->last_name}}</h6>
                            <h6>Gender: {{$evacs->household_member->person->gender}}</h6>
                            <h6>Age: {{date_diff(date_create($evacs->household_member->person->birth_date), date_create('today'))->y}}</h6>
                        </div>                           
                    </div>
                    <div class="col-md-4"> 
                            <div class="text-center">
                                @if($evacs->whereabouts == "Missing")
                                    <h6>Status: </h6><h5><span class="badge badge-danger">{{$evacs->whereabouts}}</span></h5> 
                                @else
                                    <h6>Status: {{$evacs->status}}</h6>
                                @endif
                                <h6>Remarks: {{$evacs->remarks}}</h6>
                            </div>                           
                        </div>
                    <div class="col-md-4">
                        <div class="text-right">
                            <h6>Mobile Number: {{$evacs->household_member->person->mobile_num}}</h6>
                            <h6>Email Address: {{$evacs->household_member->person->email}}</h6>
                            <h6>Other Address: 
                                @if($evacs->household_member->other_address != NULL) 
                                    {{$evacs->household_member->other_address}}
                                @else
                                    None
                                @endif
                            </h6>
                        </div>    
                    </div>
                    <div class="col-md-12 text-center">
                        @if($evacs->status != 'Deceased')
                            @if($evacs->whereabouts != 'Missing')
                                <a href="#" data-target="#dead" data-toggle="modal" role="button" class="btn btn-outline-dark btn-sm"><i class="fas fa-skull"></i> Declare Deceased</a>
                                <a href="#" data-target="#missing" data-toggle="modal" role="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-user-times"></i> Report Missing</a>
                            @else
                                <a href="#" data-target="#dead" data-toggle="modal" role="button" class="btn btn-outline-dark btn-sm"><i class="fas fa-skull"></i> Report Found and Deceased</a>
                                <a href="#" data-target="#found" data-toggle="modal" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-user-check"></i> Found and Returned Here</a>
                            @endif
                        @endif
                    </div>
                </div>          
            </div>               
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-primary">
                  <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-notes-medical"></i> Medical Information</h5></div>
                    <div class="card-body">
                            <div class="row">
                                @if($evacs->whereabouts != "Missing")
                                    <div class="col-md-6 text-left">
                                       
                                            <a href="#" data-target="#addevacMed" data-toggle="modal" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> Add Medical Record<a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                            @if($evacs->status != 'Injured/Sick')
                                                <h6><a href="#" data-target="#sick" data-toggle="modal" role="button" class="btn btn-outline-primary btn-sm"><!--<i class="fas fa-user-injured">--><i class="fas fa-wheelchair"></i> Declare Sick/Injured<a></h6>
                                            @else
                                                <h6><a href="#" data-target="#fine" data-toggle="modal" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-user-shield"></i> Declare Healthy<a></h6>
                                            @endif
                                    </div>
                                @else
                                    <div class="col-md-6 text-left">
                                        <a href="/evacuateHere" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-undo-alt"></i> Back</a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                    </div>
                                @endif
                            </div> 
                            <br>
                        <div class="table-responsive">         
                        <table class="table table-hover table-sm" id="dataTable">
                            <thead class="thead">
                                <th>Condition</th>
                                <th>Severity</th>
                                <th>Medication</th>
                                <th>Action</th>
                            </thead>
                            <tbody> 
                                @foreach($medical as $m)
                                <tr>
                                    <td>{{$m->condition}} </td>
                                    <td>{{$m->severity}} </td>
                                    <td>{{$m->medication}} </td>
                                <td> <a href="#" data-target="#editevacueeMed{{$m->id}}" data-toggle="modal" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i><a> </td>
                                </tr>
                                <!-- Edit Medical Record Modal-->
                                            <div class="modal fade" id="editevacueeMed{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content border-primary modal-lg">
                                                        <div class="modal-header bg-primary text-white modal-lg">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Edit {{$m->condition}}
                                                            </h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body modal-lg">
                                                            {!! Form::open(['action' => ['EvacuationController@updateMed', $m->id], 'method' => 'POST']) !!}
                                                            
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        {{Form::label('condition', 'Current Condition')}}
                                                                        {{Form::text('condition', $m->condition, ['class' => 'form-control', 'placeholder' => 'Current Condition', 'required' => 'required'])}}
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        {{Form::hidden('evac_id', $evacs->id)}}
                                                                        {{Form::label('severity', 'Severity')}}
                                                                        {{Form::select('severity', [
                                                                            'Fully Recovered' => 'Fully Recovered', 
                                                                            'Mild' => 'Mild',
                                                                            'Severe' => 'Severe',
                                                                            'Life-threatening' => 'Life-threatening' ],
                                                                            $m->severity,
                                                                            ['class' => 'form-control']
                                                                        )}}
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                            {{Form::label('medication', 'Medication')}}
                                                                            {{Form::text('medication', $m->medication, ['class' => 'form-control', 'placeholder' => 'Medication', 'required' => 'required'])}}
                                                                        </div>
                                                                    
                                                                </div>
                                                        </div> 
                                                        <div class="modal-footer">
                                                            <div class="text-right">
                                                                <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                                {{csrf_field()}}
                                                                {{Form::submit('Update Medical Record', ['class'=>'btn btn-outline-success'])}}
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                <!---- end of modal -->
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>    
                </div>        
            </div>
        </div>

@if($evacs->whereabouts != "Missing")
    <!-- Missing Modal-->
    <div class="modal fade" id="missing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Report {{$evacs->household_member->person->first_name}} {{$evacs->household_member->person->last_name}} as <strong>missing</strong>.
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['EvacuationController@missing', $evacs->id], 'method' => 'POST']) !!}  
                    
                    {{Form::label('remarks', 'Remarks')}}
                    {{Form::text('remarks', '', ['class' => ' form-control', 'placeholder' => 'Remarks', 'required' => 'required'])}}
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
@else 
    <!-- Found Modal-->
    <div class="modal fade" id="found" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Verify {{$evacs->household_member->person->first_name}} {{$evacs->household_member->person->last_name}}'s return in this center.
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['EvacuationController@found', $evacs->id], 'method' => 'POST']) !!}  
                    {{Form::label('status', 'Status')}}
                    {{Form::select('status', [
                                    'Fine' => 'Fine',
                                    'Injured/Sick' => 'Injured/Sick'],
                                    "",
                                    ['class' => 'form-control', 'required' => 'required']
                    )}}
                    {{Form::label('remarks', 'Remarks')}}
                    {{Form::text('remarks', '', ['class' => ' form-control', 'placeholder' => 'Remarks', 'required' => 'required'])}}
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                        {{csrf_field()}}
                        {{Form::submit('Declare as Found', ['class'=>'btn btn-outline-success'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($evacs->status != "Deceased")
    <!-- Declare dead Modal-->
    <div class="modal fade" id="dead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-dark">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Declare {{$evacs->household_member->person->first_name}} {{$evacs->household_member->person->last_name}} as <strong>deceased</strong>.
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['EvacuationController@dead', $evacs->id], 'method' => 'POST']) !!}  
                    {{Form::label('remarks', 'Remarks')}}
                    {{Form::text('remarks', '', ['class' => ' form-control', 'placeholder' => 'Remarks', 'required' => 'required'])}}
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                        {{csrf_field()}}
                        {{Form::submit('Declare as Deceased', ['class'=>'btn btn-outline-dark'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($evacs->status != "Injured/Sick")
    <!-- Declare dead Modal-->
    <div class="modal fade" id="sick" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-primary">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Declare {{$evacs->household_member->person->first_name}} {{$evacs->household_member->person->last_name}} as <strong>injured/sick</strong>.
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['EvacuationController@sick', $evacs->id], 'method' => 'POST']) !!}  
                    {{Form::label('remarks', 'Remarks')}}
                    {{Form::text('remarks', '', ['class' => ' form-control', 'placeholder' => 'Remarks', 'required' => 'required'])}}
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                        {{csrf_field()}}
                        {{Form::submit('Declare as Injured/Sick', ['class'=>'btn btn-outline-primary'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($evacs->status != "Fine")
    <!-- Fine dead Modal-->
    <div class="modal fade" id="fine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Declare {{$evacs->household_member->person->first_name}} {{$evacs->household_member->person->last_name}} as <strong>fine</strong>.
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['EvacuationController@fine', $evacs->id], 'method' => 'POST']) !!}  
                    {{Form::label('remarks', 'Remarks')}}
                    {{Form::text('remarks', '', ['class' => ' form-control', 'placeholder' => 'Remarks', 'required' => 'required'])}}
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                        {{csrf_field()}}
                        {{Form::submit('Declare as Healthy', ['class'=>'btn btn-outline-success'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Add Medical Record Modal-->
<div class="modal fade" id="addevacMed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-primary modal-lg">
            <div class="modal-header bg-primary text-white modal-lg">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Medical Record for {{$evacs->household_member->person->first_name}}
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body modal-lg">
                {!! Form::open(['action' => ['EvacuationController@evacueemedAdd', $addMed->id], 'method' => 'POST']) !!}

                <div class="row">
                    <div class="col-md-4">
                        {{Form::hidden('member_id', $addMed->household_member_id)}}
                        {{Form::label('condition', 'Condition')}}
                        {{Form::text('condition', '', ['class' => 'form-control', 'placeholder' => 'Condition', 'required' => 'required'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('severity', 'Severity')}}
                        {{Form::select('severity', [
                            'Fully Recovered' => 'Fully Recovered', 
                            'Mild' => 'Mild',
                            'Severe' => 'Severe',
                            'Life-threatening' => 'Life-threatening' ],
                            '',
                            ['class' => 'form-control']
                                )}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('medication', 'Medication')}}
                        {{Form::text('medication', '', ['class' => 'form-control', 'placeholder' => 'Medication', 'required' => 'required'])}}
                    </div>

            </div>
        </div>    
            <div class="modal-footer">
                <div class="text-right">
                    <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                    {{csrf_field()}}
                    {{Form::submit('Add Medical Record', ['class'=>'btn btn-outline-primary'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection