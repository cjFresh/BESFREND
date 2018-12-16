@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-warning">
            <div class="card-header bg-warning "><h5 class="text-center" style="color:#fffef7;"><i class="fas fa-sad-cry"></i> People Missing</h5></div>
                <div class="card-body">
                    <a href="/home" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm" id="dataTable">
                            <thead class="thead">
                                <th>Full Name</th>
                                <th>Date & Time Missing</th>
                                <th>Remarks</th>
                            </thead>        
                            <tbody> 
                                @foreach($household_evac as $he)
                                    @if($he->whereabouts == "Missing")
                                        <tr>
                                            <td>{{$he->household_member->person->first_name}} {{$he->household_member->person->last_name}}</td>
                                            <td>{{$he->updated_at}}</td>
                                            <td>{{$he->remarks}}</td>
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