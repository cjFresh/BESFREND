@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header text-white bg-primary"><h5 class="text-center"><i class="fas fa-users"></i> Incoming Aid Workers</h5></div>
            <div class="card-body">   
                <table class="table table-hover table-sm" id="dataTable">
                    <thead class="thead">
                        <th>Name</th>
                        <th>Field</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($incoming as $inc)
                                <td>{{$inc->aid_worker->person->first_name}} {{$inc->aid_worker->person->last_name}}</td>
                                <td>{{$inc->aid_worker->field}}</td>                
                                <td>{{$inc->status}}</td> 
                                <td>
                                    <a href="/confirmaidArrival/{{$inc->id}}" role="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-check"></i></a>  
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>
@endsection