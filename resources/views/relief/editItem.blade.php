@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">Update the details for {{$item_list->item->name}}</h5></div>
            <div class="card-body">
                            {!! Form::open(['action' => ['ReliefController@updateCurrentItem', $item_list->id], 'method' => 'POST']) !!}
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">    
                            {{Form::label('qty_requested', 'Quantity Requested')}}
                            {{Form::number('qty_requested', $item_list->qty_requested, ['class' => 'form-control', 'placeholder' => 'Quantity Requested'])}}
                    </div>
                    <div class="col-md-4">
                            {{Form::label('priority_level', 'Priority Level')}}
                            {{Form::select('priority_level', [
                                'Low' => 'Low', 
                                'Mid' => 'Mid',
                                'High' => 'High' ],
                                $item_list->priority_level,
                                ['class' => 'form-control']
                            )}}
                    </div>
                    <div class="col-md-2"></div>
                </div>
                
                <br>

                <div class="row justify-content-md-center">
                    {{csrf_field()}}
                <a role="button" class="btn btn-outline-danger" href="/ViewRequestItemsForm/{{$item_list->item_request_form->id}}">Cancel</a>

                    &nbsp &nbsp &nbsp {{Form::submit('Update Item', ['class'=>'btn btn-outline-success'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection