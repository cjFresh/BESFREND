@guest
<h1>You are not logged in</h1>
@else
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>{{Auth::user()->user_type}} Dashboard</h4>
                    @if(Auth::user()->user_type == "Command Center Account")
                        @php($last_evac = App\Evacuation::orderBy('id', 'desc')->withCount('household_evacs')->first())
                        <div class="card border-danger">
                            <div class="card-header text-white bg-danger text-center">
                                <h5><i class="fas fa-desktop"></i> Situation Report</h5>
                            </div>
                            @if(!$last_evac || $last_evac->status == "Done")
                            <div class="card-body text-center">
                                <h5>No evacuation has been initiated</h5>
                                <a href="#" role="button" class="btn btn-outline-danger btn-sm" data-target="#initiate" data-toggle="modal"> 
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Initiate Evacuation
                                </a>
                            </div>
                            @else
                            <div class="card-body">
                                    <h4>Current Emergency: {{$last_evac->emergency}}</h4>
                                    <h6>Remarks: {{$last_evac->remarks}}</h6>
                                <div class="row">
                                    
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <div class="card text-white bg-success o-hidden h-100">      
                                        <div class="card-body">
                                            <div class="card-body-icon">
                                                <i class="fas fa-fw fa-home"></i>
                                            </div>
                                            <?php
                                            $count = 0;
                                            
                                            foreach($household_evac as $he){
                                                if($he->center_id != NULL && $he->status != "Deceased" && $he->status != "Unknown" && $he->whereabouts != "Missing"){
                                                     $count++;
                                                }
                                            }
                                            ?>
                                        <div class="mr-5"><?php echo $count ?> People Evacuated</div>
                                        </div>
                                        <a class="card-footer text-white clearfix small z-1" href="/peopleEvacuated">
                                            <span class="float-left">View Details</span>
                                            <span class="float-right">
                                                <i class="fas fa-angle-right"></i>
                                            </span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <div class="card text-white bg-warning o-hidden h-100">
                                        <div class="card-body">
                                            <div class="card-body-icon">
                                                <i class="fas fa-fw fa-sad-cry"></i>
                                            </div>
                                            <?php
                                            $count = 0;
                                            
                                            foreach($household_evac as $he){
                                                if($he->whereabouts == "Missing"){
                                                     $count++;
                                                }
                                            }
                                            ?>
                                            <div class="mr-5"><?php echo $count ?> Reported Missing</div>
                                        </div>
                                        <a class="card-footer text-white clearfix small z-1" href="/peopleMissing">
                                            <span class="float-left">View Details</span>
                                            <span class="float-right">
                                                <i class="fas fa-angle-right"></i>
                                            </span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <div class="card text-white bg-danger o-hidden h-100">
                                        <div class="card-body">
                                            <div class="card-body-icon">
                                                <i class="fas fa-fw fa-procedures"></i>
                                            </div>
                                            <?php
                                            $count = 0;
                                            
                                            foreach($household_evac as $he){
                                                if($he->status == "Injured/Sick"){
                                                     $count++;
                                                }
                                            }
                                            ?>
                                            <div class="mr-5"><?php echo $count ?> Sick/Injured</div>
                                        </div>
                                        <a class="card-footer text-white clearfix small z-1" href="/peopleSick">
                                            <span class="float-left">View Details</span>
                                            <span class="float-right">
                                                <i class="fas fa-angle-right"></i>
                                            </span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <div class="card text-white bg-dark o-hidden h-100">
                                        <div class="card-body">
                                            <div class="card-body-icon">
                                                <i class="fas fa-fw fa-skull"></i>
                                                <!-- <i class="fas fa-fw fa-dove"></i> -->
                                            </div>
                                            <?php
                                            $count = 0;
                                            
                                            foreach($household_evac as $he){
                                                if($he->status == "Deceased"){
                                                     $count++;
                                                }
                                            }
                                            ?>
                                            <div class="mr-5"><?php echo $count ?> Deceased</div>
                                        </div>
                                        <a class="card-footer text-white clearfix small z-1" href="/peopleDeceased">
                                            <span class="float-left">View Details</span>
                                            <span class="float-right">
                                                <i class="fas fa-angle-right"></i>
                                            </span>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <a href="#" role="button" class="btn btn-outline-danger" data-target="#initiate" data-toggle="modal"> 
                                            <i class="fas fa-exclamation-triangle"></i>
                                            End Evacuation
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- Initiate Evac -->
                        <div class="modal fade" id="initiate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            @if($last_evac->status == "Ongoing" && $last_evac != NULL)
                                                Stop Evacuation Module?
                                            @else
                                                Initiate Evacuation?
                                            @endif
                                        </h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- OPEN EVACUATION -->
                                        @if(!$last_evac || $last_evac->status == 'Done')
                                            <h5>Note: Only initiate the evacuation in the event of a disaster.</h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['action' => 'EvacuationController@open', 'method' => 'POST']) !!}
                                                    {{Form::label('emergency', 'Emergency Type')}}
                                                    {{Form::select('emergency', [
                                                        'Fire' => 'Fire', 
                                                        'Typhoon' => 'Typhoon',
                                                        'Non-Typhoon Flooding' => 'Non-Typhoon Flooding',
                                                        'Tsunami' => 'Tsunami',
                                                        'Earthquake' => 'Earthquake',
                                                        'Volcanic Activity' => 'Volcanic Activity',
                                                        'Landslide' => 'Landslide',
                                                        'Mass Violence' => 'Mass Violence',
                                                        'Outbreak' => 'Outbreak'],
                                                        "",
                                                        ['class' => 'form-control']
                                                    )}}
                                                    {{Form::label('remarks', 'Remarks (if any)')}}
                                                    {{Form::text('remarks', '', ['class' => 'form-control', 'placeholder' => 'Remarks'])}}
                                                </div>
                                                
                                                <div class="col-md-12 text-center">
                                                    {{csrf_field()}}
                                                    </br>
                                                    {{Form::submit('Go', ['class'=>'btn btn-outline-danger'])}}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    </div>
                                        <!-- CLOSE EVACUATION -->
                                        @elseif($last_evac->status == "Ongoing" && $last_evac != NULL)
                                            Evacuation module of all registered users is currently enabled. Only disable the module 
                                            when it is safe for evacuees to leave the evacuation centers.
                                            </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-outline-danger" href="/close/{{$last_evac->id}}" role="button">Proceed</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <br>
                    <!-- clem codes as of 11-7-18 -->
                    @if(Auth::user()->user_type == "Household Account" && Auth::user()->household->active_check == "No")
                        <div class="card border-dark">
                            <div class="card-header bg-dark text-white">
                                <h5 class="text-center"><i class="fas fa-ban"></i> Account Deactivated</h5>
                            </div>
                            <div class="card-body">
                                <p>Please contact the command center HQ in your barangay to reactivate your account.</p>
                            </div>
                        </div>
                    @else
                    <!-- end of clem codes -->
                        <div class="card border-success">
                            <div class="card-header text-white bg-success">
                                <div class="text-center">
                                    <h5><i class="fas fa-bullhorn"></i> Latest Announcements</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Auth::user()->user_type == "Command Center Account")   
                                    <a href="/createAnnouncement" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-pencil-alt"></i> Write New Announcement</a>
                                @endif
                                <div class="col-md-12">
                                    <br>
                                    @if(count($latest_announcements) > 0)
                                    @foreach($latest_announcements as $latest_announcement)
                                        <div class="card border-success">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5><strong>{{$latest_announcement->title}}</strong></h5>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        @if(Auth::user()->user_type == "Command Center Account")
                                                        <!-- DELETE ANNOUNCEMENT -->
                                                        <a href="/deleteAnnouncement/{{$latest_announcement->id}}" role="button" class="btn btn-outline-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <!-- EDIT ANNOUNCEMENT -->
                                                        <a href="/editAnnouncement/{{$latest_announcement->id}}" role="button" class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @endif
                                                        <!-- VIEW ANNOUNCEMENT -->
                                                        <a href="/viewAnnouncement/{{$latest_announcement->id}}" role="button" class="btn btn-outline-success btn-sm">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="text-justify">{!! \Illuminate\Support\Str::words($latest_announcement->body, 100,'...')  !!}</div>
                                                <h6><strong>Written on:</strong> {{$latest_announcement->created_at}}</h6>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                    @else
                                        <h4>No announcements have been posted lately.</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif <!-- clem codes -->
                </div>
            </div>
        </div>
    @endsection
@endguest