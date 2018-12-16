@extends('layouts.app')

@section('content')
<div class="row-fluid">        
    <div class="col-md-12">
        <div class="card border-success">
          <div class="card-header bg-success text-white"><h5 class="text-center"><i class="fa fa-info-circle"></i> Center Information</h5></div>
            <div class="card-body">
                <div class="row-fluid">
                    <a href="/viewCenters" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>     
                </div>
                <br>  
                <div class="row">
                    <div class="col-md-4 text-left">
                    <h5><strong><i class="fa fa-map-marker-alt"></i> Location: {{$center->location}}</strong></h5>
                    </div>
                    <div class="col-md-4 text-center">
                    <h5><strong><i class="fa fa-user"></i> Username: {{$center  ->username}}</strong></h5>
                    </div>
                    <div class="col-md-4 text-right">
                    <h5><strong><i class="fa fa-home"></i> Accomodation: {{$center->accommodation}}</strong></h5>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<br>

    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fa fa-users"></i> Evacuees</h5></div>
            <div class="card-body">  
                <div class="table-responsive">
                    <table class="table table-hover table-sm" id="dataTable">
                        <div class="text-center">
                           
                        </div>
                        <thead class="thead">
                            <th>Full Name</th>
                            <th>Whereabouts</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach($house_evac as $h)
                                
                                <tr>
                                    <td>{{$h->household_member->person->first_name}} {{$h->household_member->person->middle_name}} {{$h->household_member->person->last_name}}</td>
                                    <td>{{$h->whereabouts}}</td>
                                    <td>{{$h->status}}</td>
                                </tr>
                             
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>
    <br>
    <div class="col-md-12">
        <div class="card border-secondary">
          <div class="card-header bg-secondary text-white"><h5 class="text-center"><i class="fa fa-boxes"></i> Inventory</h5></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm" id="dataTable">
                        <div class="text-center">
                           
                        </div>
                        <thead class="thead">
                            <th>Item</th>
                            <th>Qty</th>
                        </thead>
                        <tbody>
                            @foreach($inventory as $i)
                                
                                <tr>
                                    <td>{{$i->item->name}}</td>
                                    <td>{{$i->qty_left}} {{$i->item->unit_measurement}}</td> 
                                </tr>
                             
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>

{{-- <script>
$(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script> --}}
@endsection