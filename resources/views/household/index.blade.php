@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">  
        <div class="card border-primary"> 
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-users"></i> Household Members</h5></div>
            <div class="card-body">
                <div class="table-responsive">
                @if(count($members) > 0)    
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th></th>
                            <th>Name</th>
                            <th>Heirarchy</th>
                            <th>Mobile #</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($members as $m)
                            <tr>
                                <td>
                                    <img style="height:65px;width:65px;" class="mx-auto d-block img-thumbnail rounded-circle" src="/storage/uploads/{{$m->person->photo}}" alt="{{$m->person->first_name}} {{$m->person->last_name}}">
                                </td>
                                <td>{{$m->person->first_name}} {{$m->person->middle_name}} {{$m->person->last_name}}</td>
                                <td>{{$m->heirarchy}}</td>
                                @if($m->person->mobile_num != NULL)
                                <td>{{$m->person->mobile_num}}</td>
                                @else
                                <td>None</td>
                                @endif
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit{{$m->id}}" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="/view/{{$m->id}}" role="button" class="btn btn-outline-success btn-sm"><i class="far fa-eye"></i></a>  
                                </td>
                            </tr>
                                                            <!-- Edit Modal-->
                                                            <div class="modal fade" id="edit{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content modal-lg  border-primary">
                                                                            <div class="modal-header modal-lg bg-primary text-white">
                                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                                    Update {{$m->person->first_name}} {{$m->person->last_name}}'s Personal Information
                                                                                </h5>
                                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body modal-lg">
                                                                                {!! Form::open(['action' => ['HouseholdController@update', $m->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}  
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        {{Form::label('first_name', 'First Name *')}}
                                                                                        {{Form::text('first_name', $m->person->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        {{Form::label('middle_name', 'Middle Name')}}
                                                                                        {{Form::text('middle_name', $m->person->middle_name, ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        {{Form::label('last_name', 'Last Name *')}}
                                                                                        {{Form::text('last_name', $m->person->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        {{Form::label('gender', 'Gender *')}}
                                                                                        {{Form::select('gender', [
                                                                                            'Male' => 'Male', 
                                                                                            'Female' => 'Female'],
                                                                                            $m->person->gender,
                                                                                            ['class' => 'form-control']
                                                                                                )}}
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        {{Form::label('birth_date', 'Date of Birth *')}}
                                                                                        {{Form::date('birth_date', $m->person->birth_date, ['class' => 'form-control', 'required' => 'required'])}}
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        {{Form::label('mobile_num', 'Mobile Number')}}
                                                                                        {{Form::text('mobile_num', $m->person->mobile_num, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '11'])}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">    
                                                                                        <div class="col-md-4">
                                                                                            {{Form::label('email', 'Email')}}
                                                                                            {{Form::email('email', $m->person->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}            
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            {{Form::label('heirarchy', 'Heirarchy *')}}
                                                                                            {{Form::select('heirarchy', [
                                                                                                'Parent' => 'Parent', 
                                                                                                'Child' => 'Child',
                                                                                                'Relative' => 'Relative',
                                                                                                'Roommate' =>'Roommate',
                                                                                                'Not Applicable' => 'Not Applicable'],
                                                                                                $m->heirarchy,
                                                                                                ['class' => 'form-control', 'required' => 'required']
                                                                                                    )}}
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            {{Form::label('other_address', 'Other Address (leave blank if none)')}}
                                                                                            {{Form::text('other_address', $m->other_address, ['class' => 'form-control', 'placeholder' => 'Other Address'])}}
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="row justify-content-md-center">        
                                                                                                <div class="col-md-4">
                                                                                                    {{Form::label('photo', 'Photo')}}
                                                                                                    {{Form::file('photo', ['class' => 'form-control'])}}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="modal-footer modal-lg">
                                                                              <div class="col-md-12 text-right">  
                                                                                <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                                                {{csrf_field()}}
                                                                                {{Form::submit('Update', ['class'=>'btn btn-outline-success'])}}
                                                                                {!! Form::close() !!}
                                                                              </div>
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