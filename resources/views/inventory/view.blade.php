@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-boxes"></i> Inventory</h5></div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row" style="padding-bottom: 15px;">
                        @if(Auth::user()->user_type == "Command Center Account")
                            <a href="#" data-target="#newItem" data-toggle="modal" role="button" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-plus"></i> Add New Item to Inventory
                            </a>
                        @endif
                    </div>  
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Item</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </thead>
                            <tbody>
                                @foreach($inv as $i)
                                    <tr>
                                        <td>{{$i->item->name}}</td>
                                        <td>{{$i->item->type}}</td>
                                        <td>{{$i->qty_left}} {{$i->item->unit_measurement}}</td>
                                        <td>{{$i->updated_at}}</td>
                                        <td>
                                            <a href="#" role="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit{{$i->id}}">
                                                <i class="fas fa-edit"></i>
                                            </a>  
                                        </td>
                                    </tr>
                                    <!-- Edit Modal-->
                                    <div class="modal fade" id="edit{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content border-primary">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Update Quantity of {{$i->item->name}}
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body modal-lg">
                                                    {!! Form::open(['action' => ['InventoryController@update', $i->id], 'method' => 'POST']) !!}  
                                                    {{Form::label('qty_left', 'Quantity Left (in '.$i->item->unit_measurement.')')}}
                                                    {{Form::number('qty_left', $i->qty_left, ['class' => 'form-control', 'placeholder' => 'Quantity Left', 'required' => 'required'])}}
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-md-12 text-right">
                                                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                                        {{csrf_field()}}
                                                        {{Form::submit('Change Quantity', ['class'=>'btn btn-outline-success'])}}
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
@if(Auth::user()->user_type == "Command Center Account")
<div class="modal fade" id="newItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
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
                            {!! Form::open(['action' => 'InventoryController@addItemToInventory', 'method' => 'POST']) !!}  
                            {{Form::hidden('choice', 'existing')}}
                            {{Form::label('item', 'Item')}}
                            <select class="form-control" name="item">
                            <?php 
                                $items = App\Item::all();
                                $listedItems = App\Inventory::where('center_id', Auth::user()->center->id)->get();
                                foreach($items as $i){
                                    $flag = 0;
                                    foreach($listedItems as $l){
                                        if($l->item_id == $i->id){
                                            $flag++;
                                        }
                                    }
                                    if($flag == 0){
                            ?>
                                <option value="{{$i->id}}">{{$i->name}} (measured by {{$i->unit_measurement}})</option>
                            <?php }} ?>    
                            </select>
                            {{Form::label('qty', 'Quantity')}}
                            {{Form::number('qty', '', ['min' => 1, 'class' => ' form-control', 'placeholder' => 'Quantity', 'required' => 'required'])}}
                        </div>
                        <br>       
                        <div class="modal-footer">
                            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                            {{csrf_field()}}
                            {{Form::submit('Submit Item', ['class'=>'btn btn-outline-success'])}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col-md-12">
                            <h5>For items that are not yet recorded.</h5> 
                            {!! Form::open(['action' => 'InventoryController@addItemToInventory', 'method' => 'POST']) !!}
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
                                        ['class' => 'form-control']
                                    )}}
                                </div>
                            </div>
                            
                            {{Form::label('qty', 'Quantity and Unit')}}
                            <div class="row">
                                <div class="col-md-6">
                                    {{Form::number('qty', '', ['min' => 1, 'class' => ' form-control', 'placeholder' => 'Quantity', 'required' => 'required'])}}
                                </div>
                                <div class="col-md-6">
                                    {{Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Unit', 'required' => 'required'])}}
                                </div>
                            </div>
                            {{csrf_field()}}   
                        </div>
                        <br><div class="modal-footer">
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
@endif
@endsection