@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">History of Evacuations</h5></div>
            <div class="card-body">
                <div class="table-responsive">  
                @if(count($evacs) > 0)    
                    <table class="table table-hover table-sm" id="dataTable">
                        <div class="text-center">
                            <h6>
                                Download as <a href="/downloadEvacs"><image src="{{asset('/images/excel.png')}}" style="height:30px;width:95px;"></image></a>
                            </h6>
                        </div>
                        <thead class="thead">
                            <th>Date & Time</th>
                            <th>Emergency Type</th>
                            <th># of Evacuees</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($evacs as $e)
                                @if($e->status == "Done")
                                    <tr>
                                        <td>{{$e->created_at}}</td>
                                        <td>{{$e->emergency}}</td>
                                        <td>{{$e->household_evacs_count}}</td>
                                        <td>
                                            <a href="/viewEvacuation/{{$e->id}}" role="button" class="btn btn-outline-success btn-sm"><i class="far fa-eye"></i></a>  
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else 
                    <h4>No records of evacuation since the deployment of this system.</h4>
                @endif
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection