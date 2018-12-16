@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">   
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-users"></i> Aid Workers in Evacuation Center</h5></div>
            <div class="card-body">
                <div class="table-responsive">
                @if(count($worker) > 0)   
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Name</th>
                            <th>Field</th>
                            <th>Assigned Center</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($worker as $w)
                        <tr>
                            <td>{{$w->aid_worker->person->first_name}} {{$w->aid_worker->person->last_name}}</td>
                            <td>{{$w->aid_worker->field}}</td>
                            <td>{{$w->center->location}} in {{$w->center->barangay->brgy}}</td>
                            <td>
                                    <a href="#" role="button" data-toggle="modal" data-target="#edit{{$w->id}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> 
                                    <a href="/viewSelecetedAidWorker/{{$w->aid_worker_id}}" role="button" class="btn btn-outline-success btn-sm"><i class="far fa-eye"></i></a>  
                            </td>
                        </tr>
                        <!-- Edit Aidworker Modal-->
                        <div class="modal fade" id="edit{{$w->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header modal-lg bg-primary text-white">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                              Edit Information of {{$w->aid_worker->person->first_name}}
                                            </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body modal-lg">
                                            <div class="row">
                                                {!! Form::open(['action' => ['AidController@update', $w->aid_worker->id], 'method' => 'POST']) !!}  
                                                <div class="col-md-6">
                                                    {{Form::label('first_name', 'First Name *')}}
                                                    {{Form::text('first_name', $w->aid_worker->person->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
                                                </div>
                                                <div class="col-md-6">
                                                    {{Form::label('middle_name', 'Middle Name')}}
                                                    {{Form::text('middle_name', $w->aid_worker->person->middle_name, ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{Form::label('last_name', 'Last Name *')}}
                                                    {{Form::text('last_name', $w->aid_worker->person->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
                                                </div>
                                                <div class="col-md-6">
                                                    {{Form::label('gender', 'Gender *')}}
                                                    {{Form::select('gender', [
                                                        'Male' => 'Male',
                                                        'Female' => 'Female' ],
                                                        $w->aid_worker->person->gender,
                                                        ['class' => 'form-control', 'required' => 'required']
                                                        )}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-6">
                                                        {{Form::label('birth_date', 'Birth Date *')}}
                                                        {{Form::date('birth_date', $w->aid_worker->person->birth_date, ['class' => 'form-control', 'placeholder' => 'Birth Date', 'required' => 'required'])}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{Form::label('mobile_num', 'Mobile Number *')}}
                                                        {{Form::text('mobile_num', $w->aid_worker->person->mobile_num, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '11', 'required' => 'required'])}}
                                                    </div>
                                            </div>
                                            <div class="row">  
                                                    <div class="col-md-6">
                                                        {{Form::label('email', 'Email')}}
                                                        {{Form::email('email', $w->aid_worker->person->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{Form::label('field', 'Field *')}}
                                                        {{Form::select('field', [
                                                            'Rescue' => 'Rescue',
                                                            'Medical' => 'Medical',
                                                            'Technical' => 'Technical',
                                                            'Security' => 'Security',
                                                            'Others' => 'Others' ],
                                                            $w->aid_worker->field,
                                                            ['class' => 'form-control', 'required' => 'required']
                                                            )}}
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer modal-lg">
                                                <div class="col-md-12 text-right">
                                                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                        {{csrf_field()}}
                                                        {{Form::submit('Update', ['class'=>'btn btn-outline-success'])}}
                                                    </div>
                                                    {!! Form::close() !!}
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
@endsection