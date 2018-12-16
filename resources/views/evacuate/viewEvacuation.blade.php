@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">     
        <div class="card border-primary">
            <div class="card-header bg-primary text-white"><h5 class="text-center">Scott made this page</h5></div>
                <div class="card-body">
                    <a href="/evacHistory" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-undo-alt"></i> Back</a>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm" id="dataTable">
                            <thead class="thead">
                                <th>Name</th>
                                <th>Evacuation Center</th>  
                        </thead>
                            <tbody>
                                @foreach($evac as $h)
                                    <tr>
                                        @if($h->center_id != NULL)
                                            <td>{{$h->household_member->person->last_name}} , {{$h->household_member->person->first_name}} </td>    
                                            <td>{{$h->center_id}}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- @php(var_dump($evac)) --}}
                </div>    
        </div>
    </div>
</div> 
@endsection