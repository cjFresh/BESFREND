@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">List of Evacuees</h5></div>
            <div class="card-body">
                <a href="/evacHistory" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-undo-alt"></i> Back</a>
                <br>
                <br>
                <div class="table-responsive">
                @if(count($evacuee) > 0)    
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Name</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach($evacuee as $e)
                                <tr>
                                    <td>{{$e->household_member->person->first_name}} {{$e->household_member->person->last_name}} </td>
                                    <td>{{$e->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else 
                    <h4>No records of evacuation</h4>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection