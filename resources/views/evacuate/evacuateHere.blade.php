@extends('layouts.app')

@section('content')

<div class="row">        
    <div class="col-md-12">   
        <div class="card border-primary">
        <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-users"></i> Current Population</h5></div>    
            <div class="card-body">
                <div style="padding-bottom: 15px">
                    @php
                        $counter=0;   
                        foreach($hasEvac as $ctr){
                            if($ctr->center_id == Auth::user()->center->id){
                            $counter++;        
                            }
                        }
                    @endphp
                    @if($counter == Auth::user()->center->accommodation)
                    <h4>Center can no longer accomodate evacuees!</h4>
                    @else
                    <a href="#" data-target="#evac" data-toggle="modal" role="button" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-user"></i> Evacuate Person
                    </a>
                    @endif
                </div>
                @php
                    $counter=0;   
                    foreach($hasEvac as $ctr){
                        if($ctr->center_id == Auth::user()->center->id){
                        $counter++;        
                        }
                    }
                    echo "<h5>$counter people have evacuated at this center!</h5>"; 
                @endphp
                <h5>Center's Accomodation: {{Auth::user()->center->accommodation}}</h5>
                <div class="card border-secondary">
                    <div class="card-body">
                        <h5 class="text-center">People in this Evacuation Center</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm" id="dataTable">

                                <thead class="thead">
                                    <th>Name</th>
                                    <th>Date Evacuated</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>View</th>
                                </thead>
                                <tbody> 
                                    @foreach($hasEvac as $h)
                                        @if($h->center_id == Auth::user()->center->id)
                                            <tr>
                                                <td>{{$h->household_member->person->first_name}} {{$h->household_member->person->middle_name}} {{$h->household_member->person->last_name}}</td>
                                                <td>{{$h->updated_at}}</td>
                                                <td>
                                                    @if($h->whereabouts == "Missing")
                                                        {{$h->status}} ({{$h->whereabouts}})
                                                    @else
                                                        {{$h->status}}
                                                    @endif
                                                </td>
                                                <td>{{$h->remarks}}</td>
                                                <td>
                                                    <a href="/evacueeEdit/{{$h->id}}" role="button" class="btn btn-outline-success btn-sm"><i class="far fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!-- Evacuate Modal-->
<div class="modal fade" id="evac" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg border-success">
            <div class="modal-header modal-lg bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Evacuate People</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body modal-lg">
                <div class="col-md-12">
                    <div class="table-responsive">
                        @if(count($hasEvac) > 0)   
                            <table class="table-hover table-sm" id="dataTable">
                                <thead class="thead" style="display:block;">
                                    <th>Full Name</th>
                                    <th>Evacuated at</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Action</th>                      
                                </thead>
                                    <tbody style="display:block; height:350px; overflow-y:auto; overflow-x:hidden;">
                                        @foreach($hasEvac as $h)
                                            @if($h->center_id != Auth::user()->center->id)    
                                                <tr>
                                                    <td>{{$h->household_member->person->first_name}} {{$h->household_member->person->middle_name}} {{$h->household_member->person->last_name}}</td>
                                                @if($h->center_id == NULL)
                                                        <td>
                                                            @if($h->whereabouts == "Missing")
                                                                Reported missing.
                                                            @else 
                                                                The person hasn't Evacuated Yet!
                                                            @endif
                                                        </td>
                                                        <td>{{$h->status}}</td>
                                                        <td>{{$h->remarks}}</td>
                                                        <td>
                                                            <a href="/assignEvac/{{$h->id}}" id="test" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-home"></i> Evacuate</a>
                                                        </td>            
                                                        @if($counter == Auth::user()->center->accommodation)
                                                        <script>
                                                            document.getElementById("test").disabled = true;   
                                                        </script>
                                                        @endif
                                                @elseif($h->center_id != Auth::user()->center->id)
                                                    <td>
                                                        @if($h->whereabouts == "Missing")
                                                            <small>Last evac center: {{$h->center->location}}</small>
                                                        @else 
                                                            <p>This person is  at {{$h->center->location}} </p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($h->whereabouts == "Missing")
                                                            {{$h->status}} ({{$h->whereabouts}})
                                                        @else
                                                            {{$h->status}}
                                                        @endif
                                                    </td>
                                                    <td>{{$h->remarks}}</td>
                                                    <td>
                                                        @if($h->whereabouts == "Missing")
                                                            <a href="/assignEvac/{{$h->id}}" id="test" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-home"></i> Evacuate</a>
                                                        @endif
                                                    </td>
                                                @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-lg">
                <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
