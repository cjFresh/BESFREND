@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
              <br>  
                <h3>Medical Information</h3>
                <a href="#" data-toggle="modal" data-target="#selectInd" class="btn btn-outline-primary" role="button">Add Medical Background</a>
                <br>
                <br>
                @if(count($medical_backgrounds) > 0)
                    <table class="table table-hover" id="dataTable">
                                    <thead class="thead">
                                        <th>Household User</th>
                                        <th>Condition</th>
                                        <th>Severity</th>
                                        <th>Medication</th>
                                        <th>Action</th>
                                    </thead>
                            <tbody> 
                                @foreach($medical_backgrounds as $med)    
                                    @if($med->household_member->household->user_id == Auth::user()->id)           
                                    <tr>
                                        <td>{{$med->household_member->person->first_name}} {{$med->household_member->person->middle_name}} {{$med->household_member->person->last_name}}</td>
                                        <td>{{$med->condition}}</td>
                                        <td>{{$med->severity}}</td>
                                        <td>{{$med->medication}}</td>
                                        <td>
                                            <a href="/editMedRec/{{$med->id}}" role="button" class="btn btn-outline-primary">Change</a>  
                                        </td>
                                    @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="selectInd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Select Individual</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <ul class="last-group list-group-flush">
                    @if(count($members) > 0)
                        @foreach($members as $m)
                            <a href="/addMedrec/{{$m->id}}" class="list-group-item list-group-item-action">{{$m->person->first_name}} {{$m->person->last_name}}</a>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection