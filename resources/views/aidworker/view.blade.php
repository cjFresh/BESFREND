@extends('layouts.app')

@section('content')
<!--
<h6>
    Download as <a href="/downloadAidWorkers"><image src="/*asset('/images/excel.png'*/)" style="height:30px;width:95px;"></image></a>
</h6>  -->
<div class="row">        
    <div class="col-md-12">   
        <div class="card border-primary">    
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-users"></i> Aid Workers</h5></div>
            <div class="card-body"> 
                <div class="table-responsive"> 
                @if(count($aid) > 0)  
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th></th>
                            <th>Name</th>
                            <th>Field</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                            <tbody>
                                @foreach($aid as $a)
                                    <tr>
                                        <td>
                                            <img style="height:65px;width:65px;" class="mx-auto d-block img-thumbnail rounded-circle" src="/storage/uploads/{{$a->person->photo}}" alt="{{$a->person->first_name}} {{$a->person->last_name}}">
                                        </td>
                                        <td>{{$a->person->first_name}} {{$a->person->last_name}}</td>
                                        <td>{{$a->field}}</td>
                                        <td>{{$a->status}}</td>
                                        <td>
                                            <a href="#" data-target="#edit{{$a->id}}" data-toggle="modal" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> 
                                            <a href="/viewSelecetedAidWorker/{{$a->id}}" role="button" class="btn btn-outline-success btn-sm"><i class="far fa-eye"></i></a>  
                                        </td>
                                    </tr>
                                    <!-- Edit Modal-->
                                    <div class="modal fade" id="edit{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content modal-lg border-primary">
                                                <div class="modal-header modal-lg bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Edit {{$a->person->first_name}} {{$a->person->last_name}}'s Personal Information
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body modal-lg">
                                                    {!! Form::open(['action' => ['AidController@update', $a->id], 'method' => 'POST']) !!}  
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                {{Form::label('first_name', 'First Name')}}
                                                                {{Form::text('first_name', $a->person->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
                                                            </div>
                                                            <div class="col-md-4">
                                                                {{Form::label('middle_name', 'Middle Name')}}
                                                                {{Form::text('middle_name', $a->person->middle_name, ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
                                                            </div>
                                                            <div class="col-md-4">
                                                                {{Form::label('last_name', 'Last Name')}}
                                                                {{Form::text('last_name', $a->person->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                {{Form::label('gender', 'Gender')}}
                                                                {{Form::select('gender', [
                                                                    'Male' => 'Male', 
                                                                    'Female' => 'Female'],
                                                                    $a->person->gender,
                                                                    ['class' => 'form-control']
                                                                )}}
                                                            </div>
                                                            <div class="col-md-4">
                                                                {{Form::label('birth_date', 'Birth Date')}}
                                                                {{Form::date('birth_date', $a->person->birth_date, ['class' => 'form-control', 'placeholder' => 'Birth Date', 'required' => 'required'])}}
                                                            </div>
                                                            <div class="col-md-4">
                                                                {{Form::label('mobile_num', 'Mobile Number *')}}
                                                                {{Form::text('mobile_num', $a->person->mobile_num, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '11', 'required' => 'required'])}}
                                                            </div>
                                                        </div>
                                        
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                {{Form::label('email', 'Email')}}
                                                                {{Form::email('email', $a->person->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
                                                            </div>
                                                            <div class="col-md-4">
                                                                    {{Form::label('field', 'Field')}}
                                                                    {{Form::select('field', [
                                                                        'Rescue' => 'Rescue', 
                                                                        'Medical' => 'Medical',
                                                                        'Technical' => 'Technical',
                                                                        'Security' => 'Security',
                                                                        'Others' => 'Others' ],
                                                                        $a->field,
                                                                        ['class' => 'form-control']
                                                                    )}}
                                                            </div>
                                                        </div>                        
                                                    </div>
                                                    <div class="modal-footer modal-lg">
                                                            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                            {{csrf_field()}}
                                                            {{Form::submit('Update', ['class'=>'btn btn-outline-success'])}}
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