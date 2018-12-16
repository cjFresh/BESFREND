@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">Update the details for {{$donation->item->name}}</h5></div>
            <div class="card-body">
                {!! Form::open(['action' => ['InventoryController@updateDonationPackage', $donation->id], 'method' => 'POST']) !!}
                <div class="col-md-12">
                    {{Form::label('qty', 'Quantity Requested')}}
                    {{Form::number('qty', $donation->qty, ['min' => 1, 'class' => 'form-control', 'placeholder' => 'Quantity Requested'])}}
                </div>
                
                <br>

                <div class="col-md-12 text-center">
                    {{csrf_field()}}
                    <a role="button" class="btn btn-outline-danger" href="/viewSelectedDonation/{{$donation->relief_operation_id}}">Cancel</a>
                    {{Form::submit('Update Item', ['class'=>'btn btn-outline-success'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection