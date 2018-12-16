@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header text-white bg-primary"><h5 class="text-center"><i class="fas fa-parachute-box"></i> Incoming Reliefs</h5></div>
            <div class="card-body"> 
                <div class="table-responsive">  
                @if(count($incomingItems) > 0)  
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Name</th>
                            <th>Sender</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </thead>
                        <tbody>
                            @foreach($incomingItems as $inc)
                                @if($inc->sender_id != NULL && $inc->confirmation == "En Route")
                                    <tr>
                                        <td>{{$inc->name}}</td>   
                                        <td>{{$inc->sender->location}}</td>
                                        <td>{{$inc->confirmation}}</td>
                                        @if($inc->confirmation == 'Arrived')
                                        <td>
                                            <a role="button" class="btn btn-outline-success btn-sm" href="/viewReliefOperation/{{$inc->id}}"><i class="far fa-eye"></i></a> 
                                        </td>
                                        @else
                                        <td>
                                            <a href="/confirmArrive/{{$inc->id}}" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-check"></i></a>  
                                            <a role="button" class="btn btn-outline-success btn-sm" href="/viewReliefOperation/{{$inc->id}}"><i class="far fa-eye"></i></a>
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
    </div>
</div>

@endsection