@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-user-cog"></i> Account Settings</h5></div>
            <div class="card-body">
                    {!! Form::open(['action' => ['AccountSettingsController@updateAccountSettings', $user->id], 'onsubmit' => 'do_check();', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::label('username', 'Username')}}
                            {{Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => 'Username'])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('password', 'Enter New Password')}}
                            {{Form::input('password', 'password', '',['class' => 'form-control', 'placeholder' => 'Password'])}}
                            <a onclick="myFunction()"><i class="far fa-eye"></i> Show Password</a>
                            <input type="hidden" onkeyup='check();' /> 
                        </div>
                        <div class="col-md-4">   
                            {{Form::label('password_confirmation', 'Confirm Password')}}
                            {{Form::input('password', 'password_confirmation', '',['class' => 'form-control', 'onkeyup' => 'check()', 'placeholder' => 'Confirm Password'])}}
                            <span id='message'></span>
                        </div>
                        
                        @if(Auth::user()->user_type == 'Household Account') 
                        <div class="col-md-4">
                                {{Form::label('house_num', 'House Number')}}
                                {{Form::text('house_num', $userHouse->house_num, ['class' => 'form-control', 'placeholder' => 'House Number'])}}
                        </div>
                        <div class="col-md-4">
                                {{Form::label('street', 'Street')}}
                                {{Form::text('street', $userHouse->street, ['class' => 'form-control', 'placeholder' => 'Street'])}}
                        </div>
                        <div class="col-md-4">
                                {{Form::label('area', 'Area')}}
                                {{Form::text('area', $userHouse->area, ['class' => 'form-control', 'placeholder' => 'Area'])}}
                        </div>
                        @else
                        @endif
                    </div>
                <br>        
                <div class="row justify-content-md-center">
                    <a role="button" class="btn btn-outline-danger" href="/home">Cancel</a>

                    &nbsp &nbsp
                    {{csrf_field()}}
                    {{Form::submit('Submit', ['class'=>'btn btn-outline-success'])}} 
                    {!! Form::close() !!}
                </div>
            </div>
        </div>    
    </div> 
    <div class="col-md-2"></div>
</div>
<br>
@if(Auth::user()->user_type == 'Household Account')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card border-danger">
          <div class="card-header bg-danger text-white"><h5 class="text-center"><i class="fas fa-user-times"></i> Deactivate Account</h5></div>
            <div class="card-body">
                <h5 class="text-danger">Warning</h5>
                <p>Only deactivate this account when you and your family has moved out of the 
                    vicinity of the barangay you registered. Contact the command center of the
                    barangay for reactivation when the account has been deactivated.</p>
                <p class="text-center">
                    <a href="#" class="btn btn-outline-danger btn-sm" role="button" data-target="#deactivate" data-toggle="modal">
                        <i class="fas fa-exclamation-triangle"></i> Deactivate Account
                    </a>
                </p>
            </div>
        </div>    
    </div> 
    <div class="col-md-2"></div>
</div>
<!-- Deactivate Modal-->
<div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header text-white bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">
                    Confirmation
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure about deactivating your account?
            </div>
            <div class="modal-footer border-light">
                    <a href="/deactivateAccount/{{Auth::user()->household->id}}" class="btn btn-outline-danger" role="button">
                        Yes
                    </a>
                <button class="btn btn-outline-dark" type="button" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endif

<script>
function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('password_confirmation').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Passwords does Match!' ;
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Password do not Match!';
  }
}
</script>

@endsection
