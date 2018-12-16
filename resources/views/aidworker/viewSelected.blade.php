@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">   
        <div class="card border-primary">    
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-info-circle"></i> Aid Worker Information</h5></div>
            <div class="card-body"> 
                <div class="col-md-12">
                    <div style="padding-bottom:10px">
                                        @if(Auth::user()->user_type == "Evacuation Center Account")
                                            <a href="/viewAidHere" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                                        @else
                                            <a href="/viewAid" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                                        @endif
                        <a href="#" role="button" data-toggle="modal" data-target="#edit{{$worker->id}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> Update Information</a> 
                            @if(Auth::user()->user_type == "Command Center Account")
                                @if($worker->status == "Active")
                    <a href="/declareInactiveAid/{{$worker->id}}" class="btn btn-outline-danger btn-sm" role="button">
                                        <i class="fa fa-ban"></i> Declare Inactive
                                    </a>
                                @else
                                <a href="/declareActiveAid/{{$worker->id}}" class="btn btn-outline-success btn-sm" role="button">
                                        <i class="fa fa-check-circle"></i> Reinstate Active Status
                                    </a>
                                @endif
                            @endif
                    </div>
                    <div class="row" style="padding-bottom:10px">
                        <div class="col-md-4">
                            <h5 class="text-center"><strong>Name: {{$worker->person->first_name}} {{$worker->person->middle_name}} {{$worker->person->last_name}}</strong></h5>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center"><strong>Field: {{$worker->field}}</strong></h5>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center"><strong>Status: {{$worker->status}}</strong></h5>
                        </div>
                    </div>
                    @if(count($assignments) > 0)
                        @foreach($assignments as $a)
                            @if($loop->first)
                            @php($last_status = $a->status)
                            <div style="padding-bottom:15px;">
                                <div class="card border-danger">
                                    <div class="card-body">
                                        <h5 class="text-center"><strong>Current Center Assigned</strong></h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="text-center"><strong>
                                                    Center: @if($a->center->id == Auth::user()->center->id) 
                                                                Command Center ({{$a->center->location}})
                                                            @else 
                                                                {{$a->center->location}} 
                                                            @endif
                                                </strong></h6>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="text-center"><strong>Status: {{$a->status}}</strong></h6>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="text-center"><strong>Date Assigned: {{$a->created_at}}</strong></h6>
                                            </div>
                                        </div>
                                        @if($a->status == "En Route")
                                        <div class="col-md-12 text-center">
                                            <a href="#" class="btn btn-outline-danger btn-sm" role="button" data-toggle="modal" data-target="#cancel">
                                                <i class="fas fa-times"></i>
                                                Cancel Assignment
                                            </a>
                                        </div>
                                        @endif
                                    </div>    
                                </div>       
                            </div>                                                        <!-- Cancel Modal -->
                            <div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content border-danger">
                                        <div class="modal-header text-white bg-danger">
                                            <h5 class="modal-title" id="exampleModalLabel">Cancel Assignment</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <p>
                                                        Only cancel the aid worker's trip to the assigned center 
                                                        when something goes wrong.
                                                    </p>
                                                    <p class="text-center">
                                                        <a href="/cancelAssignment/{{$a->id}}" class="btn btn-outline-primary">
                                                            Proceed
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @else
                        @php($last_status = "Ready")
                    @endif
                    <div class="card border-secondary">
                        <div class="card-body">
                          <h5 class="text-center"><strong>Center Assignment History</strong></h5>  
                            <div class="row">
                                    <div class="col-md-6 text-left">
                                        @if($worker->status == "Active" && $last_status != "En Route")
                                            <a href="#" class="btn btn-outline-primary btn-sm" role="button" data-target="#assign" data-toggle="modal">
                                                <i class="fas fa-edit"></i> Assign to Center
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 text-right">
                                    </div>
                            </div>
                            <br>
                            <div class="table-responsive"> 
                                <table class="table table-hover table-sm" id="dataTable">
                                    <thead class="thead">
                                        <th>Date Assigned</th>
                                        <th>Center</th>
                                        <th>Status</th>
                                    </thead>
                                        <tbody>
                                            @if(count($assignments) > 0)
                                                @foreach($assignments as $a)
                                                    @if($loop->first) <!-- first kay gi bali nato, ang latest maoy pinaka una -->
                                                        @php($last_assignment_id = $a->id) <!-- gets the id -->
                                                        @php($flag = $a->center_id) <!-- flagged ni, kay di ka pwede maka assign padulong sa imong own center -->
                                                    @else
                                                    <tr>
                                                        <td>{{$a->created_at}}</td>
                                                        <td>{{$a->center->location}}</td>
                                                        <td>{{$a->status}}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            @else 
                                                @php($last_assignment_id = 0)
                                                @php($flag = 0)
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
</div>

<div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Center Assignment</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="col-md-12">
                            <h5>Assign {{$worker->first_name}} {{$worker->last_name}} to a new center.</h5>  
                            {!! Form::open(['action' => ['AidController@assignAidWorker', $worker->id], 'method' => 'POST']) !!}  
                            {{Form::hidden('last_assignment_id', $last_assignment_id)}}
                            {{Form::label('center', 'Destination Center')}}
                            <select class="form-control" name="center">
                            <?php 
                                $center = App\Center::where('id', '<>', Auth::user()->center->id)->where('brgy_id', Auth::user()->center->brgy_id)->get();
                                foreach($center as $c){
                                    if($c->id != $flag && $c->user->user_type != "Command Center Account    "){
                            ?>
                                <option value="{{$c->id}}">{{$c->location}}</option>
                                    <?php } }?>    
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                <div class="text-right">
                        {{csrf_field()}}
                        {{Form::submit('Assign Worker', ['class'=>'btn btn-outline-success'])}}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="edit{{$worker->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-primary">
                <div class="modal-header modal-lg bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Edit Information of {{$worker->person->first_name}}
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                {!! Form::open(['action' => ['AidController@update', $worker->id], 'method' => 'POST']) !!}
                <div class="modal-body modal-lg">
                    <div class="row">                       
                            <div class="col-md-6">
                                {{Form::label('first_name', 'First Name *')}}
                                {{Form::text('first_name', $worker->person->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
                            </div>
                            <div class="col-md-6">
                                {{Form::label('middle_name', 'Middle Name')}}
                                {{Form::text('middle_name', $worker->person->middle_name, ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{Form::label('last_name', 'Last Name *')}}
                            {{Form::text('last_name', $worker->person->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
                        </div>
                        <div class="col-md-6">
                            {{Form::label('gender', 'Gender *')}}
                            {{Form::select('gender', [
                                'Male' => 'Male',
                                'Female' => 'Female' ],
                                $worker->person->gender,
                                ['class' => 'form-control', 'required' => 'required']
                                )}}
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                {{Form::label('birth_date', 'Birth Date *')}}
                                {{Form::date('birth_date', $worker->person->birth_date, ['class' => 'form-control', 'placeholder' => 'Birth Date', 'required' => 'required'])}}
                            </div>
                            <div class="col-md-6">
                                {{Form::label('mobile_num', 'Mobile Number')}}
                                {{Form::text('mobile_num', $worker->person->mobile_num, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'required' => 'required'])}}
                            </div>
                    </div>
                    <div class="row">  
                            <div class="col-md-6">
                                {{Form::label('email', 'Email')}}
                                {{Form::email('email', $worker->person->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
                            </div>
                            <div class="col-md-6">
                                {{Form::label('field', 'Field *')}}
                                {{Form::select('field', [
                                    'Rescue' => 'Rescue',
                                    'Medical' => 'Medical',
                                    'Technical' => 'Technical',
                                    'Security' => 'Security',
                                    'Others' => 'Others' ],
                                    $worker->field,
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
                                {!! Form::close() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection