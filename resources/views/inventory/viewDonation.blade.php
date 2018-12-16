@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center">
                    <i class="fas fa-info-circle"></i>
                    Donation Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="text-center"><strong><i class="fa fa-clipboard"></i> Title:</strong> {{$donation->name}}</h6>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-center"><strong><i class="fa fa-users"></i> Donor:</strong> {{$donation->donor}}</h6>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-center"><strong><i class="fa fa-check-circle"></i> Status:</strong>@if($donation->confirmation == "Encoding") {{$donation->confirmation}} @else Recorded @endif</h6>
                            </div>
                        </div>
                        <!-- list of items -->
                        <h5 class="text-center"><strong><i class="fa fa-truck-loading"></i> Items in Package</strong></h5>
                        <div class="row">
                            <div class="col-md-6">
                                    <a href="/viewDonations" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                                @if($donation->confirmation == "Encoding")
                                    <a href="#" class="btn btn-outline-primary btn-sm" role="button" data-target="#selectItem" data-toggle="modal">
                                        <i class="fa fa-plus"></i> List New Item
                                    </a>
                                @endif
                                @if($donation->confirmation == "Pending")
                                    <a href="/viewDonations" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                @if($donation->confirmation == "Encoding")
                                    <!-- Delete the items in the package, and the relief operation -->
                                    <a href="/deleteDonation/{{$donation->id}}" class="btn btn-outline-danger btn-sm" role="button">
                                        <i class="fa fa-ban"></i> Cancel Record
                                    </a>

                                    <a href="/addPackageItemsToInventory/{{$donation->id}}" class="btn btn-outline-success btn-sm" role="button">
                                        <i class="fa fa-check"></i> Submit Record
                                    </a>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm" id="dataTable">
                                <thead class="thead">
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    @if($donation->confirmation == "Encoding")
                                        <th>Action</th>
                                    @endif
                                </thead>
                                <tbody>
                                    @if(count($package) > 0)
                                        @foreach($package as $p)
                                            <tr>
                                                <td>{{$p->item->name}}</td>
                                                <td>{{$p->item->type}}</td>
                                                <td>{{$p->qty}} {{$p->item->unit_measurement}}</td>
                                                @if($donation->confirmation == "Encoding")
                                                    <td>
                                                        <a role="button" class="btn btn-outline-danger btn-sm" href="#" data-toggle="modal" data-target="#remove{{$p->id}}">
                                                            <i class="far fa-trash-alt"></i> Remove
                                                        </a>
                                                        <a role="button" class="btn btn-outline-primary btn-sm" href="#" data-toggle="modal" data-target="#edit{{$p->id}}">
                                                            <i class="far fa-edit"></i> Edit
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                            <!-- Edit Modal-->
                                            <div class="modal fade" id="edit{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content border-primary">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Edit Quantity of {{$p->item->name}}
                                                            </h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(['action' => ['InventoryController@updateDonationPackage', $p->id], 'method' => 'POST']) !!}  
                                                            {{Form::label('qty', 'Quantity in '.$p->item->unit_measurement)}}
                                                            {{Form::number('qty', $p->qty, ['min' => 1, 'class' => 'form-control', 'placeholder' => 'Quantity Requested'])}}
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
                                            <!-- Remove Modal-->
                                            <div class="modal fade" id="remove{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Do you want to remove {{$p->item->name}}?</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12 text-center">
                                                                <a role="button" class="btn btn-outline-danger" href="/removeItemDonationPackage/{{$p->id}} /{{$donation->id}}">
                                                                    <i class="far fa-thumbs-up"></i> Yes
                                                                </a>
                                                                <a href="#" role="button" class="btn btn-outline-primary" data-dismiss="modal">
                                                                    <i class="far fa-thumbs-down"></i> No
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

<!-- Select Item Modal-->
@if($donation->confirmation == "Encoding")
<div class="modal fade" id="selectItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">List New Item</h5>
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
                            {!! Form::open(['action' => ['InventoryController@addItemDonation', $donation->id], 'method' => 'POST']) !!}  
                            {{Form::hidden('choice', 'existing')}}
                            {{Form::label('item', 'Item')}}
                            <select class="form-control" name="item">
                            <?php 
                                $items = App\Item::all();
                                $listedItems = App\ReliefPackage::where('relief_operation_id', $donation->id)->get();
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
                            {{Form::number('qty', 1, ['min' => 1, 'class' => ' form-control', 'placeholder' => 'Quantity'])}}
                        </div>
                        <br>
                        <div class="modal-footer">
                                <div class="col-md-12 text-right">
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
                            {!! Form::open(['action' => ['InventoryController@addItemDonation', $donation->id], 'method' => 'POST']) !!}
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
                                    {{Form::number('qty', 1, ['min' => 1, 'class' => ' form-control', 'placeholder' => 'Quantity', 'required' => 'required'])}}
                                </div>
                                <div class="col-md-6">
                                    {{Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Unit', 'required' => 'required'])}}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                                        {{csrf_field()}}   
                                        {{Form::submit('Submit Item', ['class'=>'btn btn-outline-success'])}}
                                        {!! Form::close() !!}
                                </div>
                        </div>    
                </div>
            </div>
            <br>
            </div>
        </div>
    </div>
</div>
@endif
@endsection