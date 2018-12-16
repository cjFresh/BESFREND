@extends('layouts.app')

@section('content')
<div class="row">        
    <div class="col-md-12">   
        <div class="card border-info">    
          <div class="card-header bg-info text-white"><h5 class="text-center">Accounts List</h5></div>
            <div class="card-body">
                <div class="table-responsive">  
                
                    <table class="table table-hover table-sm" id="dataTable">
                        <thead class="thead">
                            <th>Account Username</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead>
                            <tbody>
                            @foreach($allDeac as $ad)
                                    <tr>
                                    <td>{{$ad->user->username}}</td>
                                    @if($ad->active_check == 'No')
                                        <td>Deactivated</td>
                                        <td><a href="/reactivateAcc/{{$ad->id}}" role="button" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i> Re-activate</a></td>
                                    @else  
                                    <td>Account is Active</td>
                                    <td></td>
                                    @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table> 
                    
                </div>
            </div>    
        </div>    
    </div>
</div>
@endsection