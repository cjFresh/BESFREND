<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BESFREND - Welcome</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/agency.css') }}" rel="stylesheet" type="text/css">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">B.E.S.F.R.E.N.D.</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#mission">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Concept</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#wew">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          @include('inc.messages')
          <div class="intro-lead-in"><small>Brgy. Evac. System For Risky Emergencies & Natural Disasters</small></div>
          <div class="intro-heading text-uppercase">B.E.S.F.R.E.N.D.</div>
          <a class="btn btn-outline-light btn-md text-uppercase js-scroll-trigger" href="#mission">More Info</a>
          <a class="btn btn-outline-primary btn-md text-uppercase js-scroll-trigger" href="#register">Create an Account</a>
          <a class="btn btn-outline-success btn-md text-uppercase js-scroll-trigger" href="#wew">Login</a>
        </div>
      </div>
    </header>

    <!-- Mission -->
    <section id="mission">
      <div class="container text-white">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Your best friend when disaster strikes</h2>
            <h3 class="section-subheading">Evacuation management made more efficient.</h3>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-people-carry fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Disaster Preparedness</h4>
            <p>We promote disaster preparedness towards citizens by creating a user-friendly system for families and residents of the barangay.</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-hands-helping fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Life-Saving Information</h4>
            <p>Through this system, evacuation centers can access relevant information of the current situation to make the best decisions.</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-user-shield fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Web Security</h4>
            <p>With personal information entered by the users, security must be tight.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- About -->
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">The Concept</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="timeline">
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="{{ asset('/images/phone.jpg') }}" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4 class="subheading">Right Information for the Right Decisions</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">You can enter necessary information such as medical backgrounds and other addresses of your relatives or roommates which will be important during a disaster.</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="{{ asset('/images/evac.jpg') }}" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4 class="subheading">Leave None Behind</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">In an event of an evacuation, you can use the system to locate the nearest evacuation center, or report your missing household members.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="{{ asset('/images/rescue.jpg') }}" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4 class="subheading">Informed Resource Allocation</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Equipped with the right information, emergency staff can allocate the resources to places where they are needed the most.</p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- registration -->
    <section id="register">
        <div class="container">
            <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">Register</h2>
                <h3 class="section-subheading text-muted">Register an account for you and your family.</h3>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-12 text-white">
                {!! Form::open(['action' => 'RegistrationController@store', 'method' => 'POST']) !!}
                <small>Required *</small>
                <h4>Account Details</h4>
                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('username', 'Username *')}}
                        {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('password', 'Enter New Password')}}
                        {{Form::input('password', 'password', '',['class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required'])}}
                        <a onclick="myFunction()"><i class="far fa-eye"></i> Show Password</a>
                        <input type="hidden" onkeyup='check();' /> 
                    </div>
                    <div class="col-md-4">   
                        {{Form::label('password_confirmation', 'Confirm Password')}}
                        {{Form::input('password', 'password_confirmation', '',['class' => 'form-control', 'onkeyup' => 'check()', 'placeholder' => 'Confirm Password', 'required' => 'required'])}}
                        <span id='message'></span>
                    </div>
                </div>
                
                <br>
    
                <h4>Home Address</h4>
                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('house_no', 'House Number *')}}
                        {{Form::text('house_no', '', ['class' => 'form-control', 'placeholder' => 'House Number', 'required' => 'required'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('street', 'Street *')}}
                        {{Form::text('street', '', ['class' => 'form-control', 'placeholder' => 'Street', 'required' => 'required'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('area', 'Sitio/Residential Area *')}}
                        {{Form::text('area', '', ['class' => 'form-control', 'placeholder' => 'Sitio/Residential Area', 'required' => 'required'])}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('brgy_id', 'Barangay *')}}
                        {{Form::select('brgy_id', $brgy->pluck('brgy', 'id'), null, ['class' => 'form-control', 'required' => 'required'])}}
                    </div>
                </div>
    
                <br>
    
                <h4>Registrant's Information</h4>
                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('first_name', 'First Name *')}}
                        {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'required'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('middle_name', 'Middle Name')}}
                        {{Form::text('middle_name', '', ['class' => 'form-control', 'placeholder' => 'Middle Name'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('last_name', 'Last Name *')}}
                        {{Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'required'])}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        {{Form::label('gender', 'Gender *')}}
                        {{Form::select('gender', [
                            'Male' => 'Male', 
                            'Female' => 'Female'],
                            "",
                            ['class' => 'form-control', 'required' => 'required']
                        )}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('birth_date', 'Date of Birth *')}}
                        {{Form::date('birth_date', date('d-M-y'), ['class' => 'form-control', 'required' => 'required'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('mobile_num', 'Mobile Number *')}}
                       
                        <div class="row">
                          <div class="col-sm-3">
                            {{Form::text('', '', ['class' => 'form-control', 'placeholder' => '+63' ,'value' => '+63' , 'readonly','color' => 'black'])}}
                          </div>
                          <div class="col-sm-9">
                          {{Form::text('mobile_num', '', ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => '10', 'required' => 'required'])}}
                          </div>  
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-md-4">
                        {{Form::label('email', 'Email')}}
                        {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
                    </div>
                </div>
                <br>
                <div class="col-md-12 text-center">
                    <small>Note: you can add more people in this account later.</small>
                    <br>
                    <br>
                    {{csrf_field()}}
                    {{Form::submit('Submit', ['class'=>'btn btn-outline-success'])}}
                    {!! Form::close() !!}
                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- login -->
    <section id="wew">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
          <h5>Already have an account? Log in!</h5>
          <br>
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
                <div class="row justify-content-center">
                  <div class="col-md-6">
                    <h5>Username</h5>
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                      @if ($errors->has('username'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('username') }}</strong>
                          </span>
                      @endif
                    <br>
                    <h5>Password</h5>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <br>
                  <button type="submit" class="btn btn-outline-primary">
                      {{ __('Login') }}
                  </button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section class="text-white" style="background-image: url('../images/dis.png'); background-repeat: no-repeat; background-size:cover;">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h3 class="intro-heading text-uppercase">B.E.S.F.R.E.N.D.</h3>
            <p style="font-size:17px;">Barangay Evacuation System For Risky Emergencies & Natural Disasters (B.E.S.F.R.E.N.D.) is a 
              web application project with the goal of making evacuations and emergency management more efficient
              with the use of information technology.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="copyright">Copyright &copy; B.E.S.F.R.E.N.D. {{date('Y')}}</span>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset("/js/jquery.js") }}"></script>
    <script src="{{ asset("/js/bootstrap.bundle.min.js") }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset("/js/jquery.easing.min.js") }}"></script>

    <!-- Contact form JavaScript -->
    <script src="{{ asset("/js/jqBootstrapValidation.js") }}"></script>
    <script src="{{ asset("/js/contact_me.min.js") }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset("/js/agency.min.js") }}"></script>
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
            document.getElementById('message').style.color = 'lightgreen';
            document.getElementById('message').innerHTML = 'Passwords does Match!' ;
          } else {
            document.getElementById('message').style.color = 'pink';
            document.getElementById('message').innerHTML = 'Passwords do not Match!';
          }
        }
        </script>
        
  </body>

</html>
