@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
            <div class="card border-success">
                <div class="card-header bg-success text-white"><h5 class="text-center"><i class="fas fa-info-circle"></i> Item Request Information</h5></div>
                <div class="card-body">
                    <a href="/requestItems" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    <br>
                    <br>
                    <h6>Reason: {{$request->reasons}}</h6>
                    <h6>Status: {{$request->status}}</h6>
                    <h6>Date Requested: {{$request->created_at}}</h6>
                </div>
            </div>
            <br/>
            <div class="card border-primary ">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center"><i class="fas fa-clipboard-list"></i> List of Items Requested</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-left">
                                @if($request->status == "Encoding")
                                    <a href="#" role="button" data-toggle="modal" data-target="#selectItem" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-plus"></i>
                                    Request Item
                                    </a>
                                @else
                                    <button href="#" role="button" data-toggle="modal" data-target="#selectItem" class="btn btn-outline-primary btn-sm" disabled>
                                        <i class="fas fa-plus"></i>
                                    Request Item
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                @if($request->status == "Encoding")
                                    <a href="/deleteItemRequest/{{$request->id}}" role="button" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                        Cancel
                                    </a>
                                    <a href="/submitItemRequest/{{$request->id}}" role="button" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-check"></i>
                                        Submit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="table-responsive">
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Item</th>
                            <th>Quantity Requested</th>
                            <th>Priority</th>
                            <th>Action</th>
                        </thead>
                        <tbody> 
                            @foreach($request->item_request_lists as $list)
                                <tr>
                                    <td>{{$list->item->name}}</td>
                                    <td>{{$list->qty_requested}}</td>
                                    <td>{{$list->priority_level}}</td>
                                    <td>
                                        @if($request->status == "Encoding")
                                            <a role="button" class="btn btn-outline-danger btn-sm" href="#" data-target="#remove{{$list->id}}" data-toggle="modal">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                            <a href="#" data-target="#edit{{$list->id}}" data-toggle="modal" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        @else
                                            <button href="#" type="button" class="btn btn-outline-danger btn-sm" disabled><i class="far fa-trash-alt"></i></button>
                                            <button href="#" type="button" class="btn btn-outline-primary btn-sm" disabled><i class="fas fa-edit"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Edit Modal-->
                                <div class="modal fade" id="edit{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content border-primary">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Update Quantity of {{$list->item->name}}
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(['action' => ['ReliefController@updateCurrentItem', $list->id], 'method' => 'POST']) !!}  
                                                {{Form::label('qty_requested', 'Quantity Requested')}}
                                                {{Form::number('qty_requested', $list->qty_requested, ['class' => 'form-control', 'placeholder' => 'Quantity Requested'])}}
                                                {{Form::label('priority_level', 'Priority Level')}}
                                                {{Form::select('priority_level', [
                                                    'Low' => 'Low', 
                                                    'Mid' => 'Mid',
                                                    'High' => 'High' ],
                                                    $list->priority_level,
                                                    ['class' => 'form-control']
                                                )}}
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-12 text-right">
                                                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                        {{csrf_field()}}
                                                        {{Form::submit('Update Item', ['class'=>'btn btn-outline-success'])}}
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

    <!-- Select Item Modal-->
    <div class="modal fade" id="selectItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-primary">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Request New Item</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Select Item</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add New Item</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-md-12">
                                <h5>For items that are already recorded.</h5>  
                                {!! Form::open(['action' => ['ReliefController@requestSelectNewItem', $request->id], 'method' => 'POST']) !!}  
                                {{Form::hidden('choice', 'existing')}}
                                {{Form::label('item', 'Item')}}
                                <select class="form-control" name="item">
                                <?php 
                                    $items = App\Item::all();
                                    foreach($items as $i){
                                        $flag = 0;
                                        foreach($request->item_request_lists as $list){
                                            if($list->item_id == $i->id){
                                                $flag++;
                                            }
                                        }
                                        if($flag == 0){
                                ?>
                                    <option value="{{$i->id}}">{{$i->name}} (measured by {{$i->unit_measurement}})</option>
                                <?php } }?>    
                                </select>
                                {{Form::label('qty', 'Quantity')}}
                                {{Form::number('qty', '', ['min' => 1, 'class' => ' form-control', 'placeholder' => 'Quantity', 'request' => 'request'])}}
                                {{Form::label('priority', 'Priority Level')}}
                                {{Form::select('priority', [
                                    'Low' => 'Low',
                                    'Mid' => 'Mid',
                                    'High' => 'High'],
                                    "",
                                    ['class' => 'form-control', 'request' => 'request']
                                )}}
                            </div>
                            <br>
                            <div class="modal-footer">
                                    <div class="text-right">
                                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                        {{csrf_field()}} 
                                        {{Form::submit('Submit Item', ['class'=>'btn btn-outline-success'])}}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col-md-12">
                                <h5>For items that are not yet recorded.</h5> 
                                {!! Form::open(['action' => ['ReliefController@requestSelectNewItem', $request->id], 'method' => 'POST']) !!}
                                {{Form::hidden('choice', 'new')}}
                                <div class="row">
                                    <div class="col-md-6">
                                        {{Form::label('item', 'Item')}}
                                        {{Form::text('item', '', ['class' => 'form-control', 'placeholder' => 'Item Name', 'required' => 'required'])}}
                                    </div>
                                    <div class="col-md-6">
                                        {{Form::label('type', 'Item Type')}}
                                        {{Form::select('type', [
                                            'Food' => 'Food',
                                            'Medicine' => 'Medicine',
                                            'Clothing' => 'Clothing',
                                            'Equipment' => 'Equipment',
                                            'Others' => 'Others'],
                                            "",
                                            ['class' => 'form-control', 'request' => 'request']
                                        )}}
                                    </div>
                                </div>
                                
                                {{Form::label('qty', 'Quantity and Unit')}}
                                <div class="row">
                                    <div class="col-md-6">
                                        {{Form::number('qty', '', ['min' => 1, 'class' => ' form-control', 'placeholder' => 'Quantity', 'request' => 'request'])}}
                                    </div>
                                    <div class="col-md-6">
                                        {{Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Unit', 'required' => 'required'])}}
                                    </div>
                                </div>
                                {{Form::label('priority', 'Priority Level')}}
                                {{Form::select('priority', [
                                    'Low' => 'Low',
                                    'Mid' => 'Mid',
                                    'High' => 'High'],
                                    "",
                                    ['class' => 'form-control', 'request' => 'request']
                                )}}  
                            </div>
                            <br>
                            <div class="modal-footer">
                                    <div class="text-right">
                                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                        {{csrf_field()}} 
                                        {{Form::submit('Submit Item', ['class'=>'btn btn-outline-success'])}}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection