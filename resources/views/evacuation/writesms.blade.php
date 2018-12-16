@extends('layouts.app')

@section('content')
<script src="http://code.jquery.com/jquery-1.5.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">Write Custome message</h5></div>
            <div class="card-body"> 
                        {!! Form::open(['action' => 'smsController@customsms', 'method' => 'POST']) !!}  
                <div class="row">
                    
                    <div class="col-md-4">
                        {{Form::label('number', 'Number')}}
                        <select class="form-control" name="number">
                                @foreach($people as $p) 
                        <option value="{{$p->mobile_num}}">{{$p->first_name}} {{$p->middle_name}} {{$p->last_name}} ({{$p->mobile_num}})</option>
                                @endforeach  
                                </select>                       
                    </div>
                    <div class="col-md-8">
                        {{Form::label('message', 'Message')}}
                        {{Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Message ', 'style' => 'resize: none', 'onkeyup' => 'countChar(this)' ])}}
                        <div>
                            Characters Left 
                            <div id="count">100</div>
                        </div>
                        
                    </div> 
                </div>
                
                <br>
                <div class="row justify-content-md-center">
                    {{csrf_field()}}
                        {{Form::submit('Send', ['class'=>'btn btn-outline-success'])}}

                        &nbsp &nbsp &nbsp 
                        {!! Form::close() !!}
                </div>
            </div>
        </div>        
    </div>
</div>

<script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 100) {
          val.value = val.value.substring(0, 100);
        } else {
          $('#count').text(100 - len);
        }
      };
    </script>
@endsection