@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="text-center">
    <h4>Status Report</h4>
    </div>
    <br>
    <div class="row">        
        <div class="col-md-12">   
                @if(count($stats) > 0)  
                <table class="table table-hover" id="dataTable">
                    <thead class="thead">
                        <th>Name</th>
                        <th>Center</th>
                        <th>Whereabouts</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Time</th>
                        <th>dasdas</th>
                    </thead>
                    <tbody>
                    @foreach($stats as $s)
                        @if($s->household_member->household->user_id == Auth::user()->id)      
                        <tr>
                            <td>{{$s->household_member->person->first_name}} {{$s->household_member->person->last_name}}</td>
                            <td>{{$s->center->barangay->brgy}}</td>
                            <td>{{$s->whereabouts}}</td>   
                            <td>{{$s->status}}</td>
                            <td>{{$s->remarks}}</td>  
                            <td>{{$s->created_at}}</td>
                            <td>
                            <a href="/editStat/{{$s->id}}" role="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>  
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>


@endsection