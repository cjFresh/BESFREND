@extends('layouts.app')

@section('content')
        <div class="card border-success">
          <div class="card-header bg-success text-white"><h5 class="text-center"><i class="fas fa-user-alt"></i> Household Member Information</h5></div>
            <div class="card-body">
                <div class="row-fluid text-left">
                    <a href="/viewHousehold" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <img style="height:200px;width:200px;" class="mx-auto d-block img-thumbnail rounded-circle" src="/storage/uploads/{{$household_member->person->photo}}" alt="{{$household_member->person->first_name}} {{$household_member->person->last_name}}">
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="text-left">   
                            <h6>Full Name: {{$household_member->person->first_name}} {{$household_member->person->middle_name}} {{$household_member->person->last_name}} </h6>
                            <h6>Gender: {{$household_member->person->gender}}</h6>
                            <h6>Birthday: {{$household_member->person->birth_date}}</h6>
                        </div>                           
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
                            <h6>Mobile Number:
                                    @if( $household_member->person->mobile_num != NULL) 
                                    {{$household_member->person->mobile_num}}
                                    @else
                                    None
                                    @endif
                            </h6>
                            <h6>Email Address: 
                                    @if( $household_member->person->email != NULL) 
                                    {{$household_member->person->email}}
                                    @else
                                    None
                                    @endif
                            </h6>
                            <h6>Other Address: 
                                    @if( $household_member->other_address != NULL) 
                                    {{$household_member->other_address}}
                                    @else
                                    None
                                    @endif
                            </h6>
                        </div>    
                    </div>
                </div>           
            </div>               
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-primary">
                  <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-file-prescription"></i> Medical History</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="#" data-toggle="modal" data-target="#add" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> Add Medical Record<a>
                            </div> 
                            <div class="col-md-6 text-right">
                                
                            </div>
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
                                        @foreach($medical_backgrounds as $m)
                                        <tr>
                                            <td>{{$m->condition}} </td>
                                            <td>{{$m->severity}} </td>
                                            <td>{{$m->medication}} </td>
                                            <td> <a href="#" data-toggle="modal" data-target="#edit{{$m->id}}" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i><a> </td>
                                        </tr>
                                        <!-- Edit Modal-->
                                        <div class="modal fade" id="edit{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content border-primary">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                           Medical Condition of {{$m->household_member->person->first_name}}
                                                        </h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body modal-lg">
                                                        {!! Form::open(['action' => ['MedicalRecordController@update', $m->id], 'method' => 'POST']) !!}  
                                                        {{Form::label('condition', 'Current Condition *')}}
                                                        {{Form::text('condition', $m->condition, ['class' => 'form-control', 'placeholder' => 'Current Condition', 'required' => 'required'])}}
                                                
                                                        {{Form::label('severity', 'Severity *')}}
                                                        {{Form::select('severity', [
                                                            'Fully Recovered' => 'Fully Recovered', 
                                                            'Mild' => 'Mild',
                                                            'Severe' => 'Severe',
                                                            'Life-threatening' => 'Life-threatening' ],
                                                            $m->severity,
                                                            ['class' => 'form-control', 'required' => 'required']
                                                        )}}
                                                        {{Form::label('medication', 'Medication *')}}
                                                        {{Form::text('medication', $m->medication, ['class' => 'form-control', 'placeholder' => 'Medication', 'required' => 'required'])}}
                                                    </div>
                                                    <div class="modal-footer">
                                                            <div class="col-md-12 text-right" style="padding-top:15px;">
                                                                    <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                                    {{csrf_field()}}
                                                                    {{Form::submit('Update Medical Condition', ['class'=>'btn btn-outline-success'])}}
                                                                    {!! Form::close() !!}
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>    
                </div>        
            </div>
        </div>
        <!-- Add Modal-->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-primary">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Medical Condition
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body modal-lg">
                        <h5>Required *</h5>
                        {!! Form::open(['action' => 'MedicalRecordController@store', 'method' => 'POST']) !!}  
                        {{Form::label('condition', 'Current Condition *')}}
                        {{Form::text('condition', '', ['class' => 'form-control', 'placeholder' => 'Current Condition', 'required' => 'required'])}}
                        {{Form::hidden('id', $household_member->id)}}
                        {{Form::label('severity', 'Severity *')}}
                        {{Form::select('severity', [
                            'Fully Recovered' => 'Fully Recovered', 
                            'Mild' => 'Mild',
                            'Severe' => 'Severe',
                            'Life-threatening' => 'Life-threatening' ],
                            '',
                            ['class' => 'form-control', 'required' => 'required']
                        )}}
                        {{Form::label('medication', 'Medication *')}}
                        {{Form::text('medication', '', ['class' => 'form-control', 'placeholder' => 'Medication', 'required' => 'required'])}}
                    </div>
                    <div class="modal-footer">
                            <div class="col-md-12 text-right" style="padding-top:15px;">
                                    <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                    {{csrf_field()}}
                                    {{Form::submit('Add Medical Condition', ['class'=>'btn btn-outline-primary'])}}
                                    {!! Form::close() !!}
                                </div>        
                    </div>
                </div>
            </div>
        </div>
@endsection