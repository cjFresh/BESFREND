@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-success">          
         <div class="card-header bg-success text-white"><h5 class="text-center">{{$announce->title}}</h5></div>
            <div class="card-body">
                <h6 class="text-justify">{!! $announce->body !!}</h6>
                <h6><strong>Written on: </strong>{{$announce->created_at}}</h6>
                <a href="/home" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection