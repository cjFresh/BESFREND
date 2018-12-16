@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-danger">
            <div class="card-header bg-danger"><h5 class="text-center" style="color:#fffef7;"><i class="fas fa-procedures"></i> People Injured/Sick</h5></div>
                <div class="card-body">
                    <a href="/home" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    <br>
                    <br>
                    <div class="table-responsive">  
                        <table class="table table-hover table-sm" id="dataTable">
                            <thead class="thead">
                                <th>Full Name</th>
                                <th>Current Evac Center</th>
                            </thead>        
                            <tbody> 
                                @foreach($household_evac as $he)
                                    @if($he->status == "Injured/Sick")
                                        <tr>
                                            <td>{{$he->household_member->person->first_name}} {{$he->household_member->person->last_name}}</td>
                                            <td>
                                                @if($he->center_id == NULL)
                                                    Not Evacuated Yet
                                                @else
                                                    {{$he->center->location}}
                                                @endif
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
@endsection