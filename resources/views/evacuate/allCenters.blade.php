@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white">
              <h5 class="text-center">Evac Centers Under This Command Center</h5>
          </div>

            <div class="card-body"> 
                 <div class="text-center">
                    <p>Evacuation:
                        <a href="#" data-toggle="modal" data-target="#initiate">
                            @if(!$evac || $evac->status == 'Done')
                                Not Initiated
                            @elseif($evac->status == "Ongoing" && $evac != NULL)
                                Initiated
                            @endif
                        </a>
                    </p>
                     
                    @if($evac->status == "Ongoing" && $evac != NULL)
                            <p>Send Warning SMS:    
                            <button type="button" class="btn btn-outline-danger btn-sm" href="#" data-target="#Confirmsms" data-toggle="modal">
                            Send SMS
                        </button>
                    @endif
                    </p>
                </div>  
                <div class="table-responsive">       
                @if(count($centers) > 0)  
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Username</th>
                            <th>Location</th>
                            <th>Accommodation</th>
                            <th>Action</th>
                        </thead>
                            <tbody>
                                @foreach($centers as $c)
                                    <tr>
                                        <td>{{$c->user->username}}</td>
                                        <td>{{$c->location}}</td>
                                        <td>{{$c->accommodation}}</td>
                                        <td>
                                        <a href="/viewpop/{{$c->id}}" role="button" class="btn btn-outline-success btn-sm">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                 @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Initiate Evac -->
<div class="modal fade" id="initiate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @if($centers[1]->barangay->initiate_evac == 'Yes')
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
                @if(!$evac || $evac->status == 'Done')
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
                @elseif($evac->status == "Ongoing" && $evac != NULL)
                    Evacuation module of all registered users is currently enabled. Only disable the module 
                    when all are present and accounted for.
                    </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-outline-danger" href="/close/{{$evac->id}}" role="button">Proceed</a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Proceed Modal-->
<div class="modal fade" id="Confirmsms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Send Warning Message</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Pressing Send Will send a warning message to the registered Household members.  
            </div>
            <div class="modal-footer">
                            
            <a href="/sendsms" role="button" class="btn btn-outline-danger btn-sm">  Send </a> 
            <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
@endsection