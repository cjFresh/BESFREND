@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-dark">
            <div class="card-header bg-dark text-white"><h5 class="text-center""><i class="fas fa-skull"></i> People Deceased</h5></div>
                <div class="card-body">
                    <a href="/home" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm" id="dataTable">
                                <thead class="thead">
                                    <th>Full Name</th>
                                    <th>Date & Time of Death</th>
                                </thead>        
                                <tbody> 
                                    @foreach($household_evac as $he)
                                        @if($he->status == "Deceased")
                                        <tr>
                                            <td>{{$he->household_member->person->first_name}} {{$he->household_member->person->last_name}}</td>
                                            <td>{{$he->updated_at}}</td>
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
@endsection