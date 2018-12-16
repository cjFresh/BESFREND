@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center"><i class="fas fa-info-circle"></i> Relief Operation Details</h5>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <h6 class="text-center"><strong><i class="fa fa-clipboard"></i> Operation:</strong> {{$reliefOperation->name}}</h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-center"><strong><i class="fa fa-map-marker-alt"></i> Destination:</strong> {{$reliefOperation->center->location}}</h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-center"><strong><i class="fa fa-users"></i> Center Population:</strong> {{$population}}</h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-center"><strong><i class="fa fa-check-circle"></i> Status:</strong> {{$reliefOperation->confirmation}}</h6>
                            </div>
                        </div>
                        <!-- list of items -->
                        <h5 class="text-center"><strong><i class="fa fa-truck-loading"></i> Items in Package</strong></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- romeo edited this part -->
                                    @if(Auth::user()->center->id == $reliefOperation->sender_id) 
                                        <a href="/viewAllRelief" class="btn btn-outline-success btn-sm" role="button"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                                    @elseif(Auth::user()->center->id != $reliefOperation->sender_id) 
                                        <a href="/incomingRelief" class="btn btn-outline-success btn-sm" role="button"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                                    @endif
                                <!-- end romeo -->
                                @if($reliefOperation->confirmation == "Encoding")
                                    <a href="#" class="btn btn-outline-primary btn-sm" role="button" data-target="#selectItem" data-toggle="modal">
                                        <i class="fa fa-plus"></i> Add Item in Package
                                    </a>
                                @elseif($reliefOperation->confirmation == "En Route")
                                    <!-- Package has not arrived yet -->
                                    <!--I edited this part -kamandag -->
                                    @if(Auth::user()->center->id == $reliefOperation->sender_id) 
                                    <a href="/cancelReliefOpDeployment/{{$reliefOperation->id}}" class="btn btn-outline-danger btn-sm" role="button">
                                        <i class="fa fa-times"></i> Cancel Deployment
                                    </a>
                                    @endif
                                    <!-- end of I edited this part -->
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                @if($reliefOperation->confirmation == "Encoding")
                                    <!-- Delete the items in the package, and the relief operation -->
                                    <a href="/cancelReliefOperation/{{$reliefOperation->id}}" class="btn btn-outline-danger btn-sm" role="button">
                                        <i class="fa fa-ban"></i> Discard Operation
                                    </a>
                                    @if(count($package) > 0)
                                        <a href="/deployReliefOperation/{{$reliefOperation->id}}" class="btn btn-outline-success btn-sm" role="button">
                                            <i class="fa fa-chevron-circle-right"></i> Deploy 
                                        </a>
                                    @endif
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
                                    @if($reliefOperation->confirmation == "Encoding")
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
                                                @if($reliefOperation->confirmation == "Encoding")
                                                    <td>
                                                        <a role="button" class="btn btn-outline-danger btn-sm" href="/removeItemReliefPackage/{{$p->id}} /{{$reliefOperation->id}}">
                                                            <i class="far fa-trash-alt"></i> Remove
                                                        </a>
                                                        <a role="button" class="btn btn-outline-primary btn-sm" href="#" data-toggle="modal" data-target="#editPackage{{$p->id}}">
                                                            <i class="far fa-edit"></i> Edit
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                            <!-- Edit Modal-->
                                    <div class="modal fade" id="editPackage{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content border-primary">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Update Quantity of {{$p->item->name}}
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body modal-lg">
                                                    {!! Form::open(['action' => ['ReliefController@editItemPackage', $p->id], 'method' => 'POST']) !!}  
                                                    {{Form::label('qty', 'Quantity (in '.$p->item->unit_measurement.')')}}
                                                    {{Form::number('qty', $p->qty, ['class' => 'form-control', 'placeholder' => 'Quantity', 'required' => 'required'])}}
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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Select Item Modal-->
    @if($reliefOperation->confirmation == "Encoding")
    <div class="modal fade" id="selectItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-primary">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Pack New Item</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-md-12">
                                <h5>Select items from the inventory.</h5>  
                                {!! Form::open(['action' => ['ReliefController@addItemReliefPackage', $reliefOperation->id], 'method' => 'POST']) !!}  
                                {{Form::label('item', 'Item')}}
                                <select class="form-control" name="item" id="itemSelect">
                                <?php 
                                    $inv = App\Inventory::with('item')->where('center_id', Auth::user()->center->id)->get();
                                    $package = App\ReliefPackage::where('relief_operation_id', $reliefOperation->id)->get();
                                    foreach($inv as $i){
                                        $flag = 0;
                                        foreach($package as $p){
                                            if($p->item_id == $i->item_id){
                                                $flag++;
                                            }
                                        }
                                        if($flag == 0){
                                ?>
                                    <option value="{{$i->item_id}}">{{$i->item->name}} (measured by {{$i->item->unit_measurement}})</option>
                                <?php } }?>    
                                </select>
                                @php
                                    
                                @endphp
                                {{Form::label('qty', 'Quantity')}}
                                    <?php
                                        foreach($inv as $i){
                                            $flag = 0;
                                            foreach($package as $p){
                                                if($p->item_id == $i->item_id){
                                                    $flag++;
                                                    }
                                                }
                                                if($flag == 0){
                                            
                                                    $limit = $i->qty_left / $center_count;
                                                    $ctr = 1;
                                                    $quantity = 1;
                                                    // $var = round($limit);
                                                    while($ctr <= $population){
                                                        if($ctr % 20 == 0){
                                                            $quantity++;
                                                        }
                                                        $ctr++;
                                                    }
                                                    if($quantity > $limit){
                                                        $quantity = round($limit);
                                                    }
                                        
                                        /*********************************************/
                                        /* FORMULA EXPLANATION                       */
                                        /* 1) for every 20 people, +1 box ihatag     */
                                        /* 2) dapat di mulapas ang quantity sa limit */
                                        /*********************************************/
                                        ?>
                                    <input type="hidden" id="row{{$i->item_id}}" value="{{$quantity}}">
                                    <?php  } } ?>
                                <input type="number" value="" min="1" class="form-control" id="qty1" name="qty1" placeholder="Quantity" required>
                                {{csrf_field()}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
                        {{Form::submit('Submit Item', ['class'=>'btn btn-outline-primary'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // $('.quantity').hide();
            $('#itemSelect').change(function(){
                
                // OLDER CODE
                // $('.quantity').hide();
                // $('#qty'+$(this).val()).show();
                // $('input:hidden').val($(this).val());

                // getting the value of a hidden input with the id of row(item_id): row1, row2, row3, etc.
                var calculation = $('#row'+$(this).val()).val();
                // changing the value of the input form with the id of #qty
                $('#qty1').val(calculation); 
            
            });
        });
    </script>
    @endif
@endsection