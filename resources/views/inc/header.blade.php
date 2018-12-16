
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="/home">{{ Auth::user()->user_type }} - {{ Auth::user()->username }}</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      @if(Auth::user()->user_type == "Household Account")
      <li class="nav-item mx-1">
        <a class="nav-link" href="#" role="button" data-toggle="modal" data-target="#helpModal" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-info-circle fa-fw"></i>
        </a>
      </li>
      @endif
      
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <!-- clem codes -->
          @if(Auth::user()->user_type == "Household Account" && Auth::user()->household->active_check == "No")
          @else
          <a class="dropdown-item" href="/accountSettings">Settings</a>
          @endif
          <!-- end of clem codes -->
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>

    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      @if(Auth::user()->user_type == "Household Account" && Auth::user()->household->active_check != "No") <!-- clem codes -->
        <!-- Household Members -->
        
        <li class="nav-item">
          <a class="nav-link" href="/viewHousehold">
            <i class="fas fa-users"></i>
            <span>Household Members</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/addHousehold">
            <i class="fas fa-user-plus"></i>
            <span>Add New Member</span>
          </a>
        </li>
        <!-- Evacuate -->
        <?php 
          $evac = App\Evacuation::where('brgy_id', Auth::user()->household->brgy_id)
                                  ->orderBy('id', 'desc')
                                  ->first();
          if($evac->status == "Ongoing"){
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-exclamation-triangle"></i>
              <span>Evacuate</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item" href="/viewcenters">Center Location</a>
              <a class="dropdown-item" href="/status">Status Report</a>
            </div>
          </li>
        <?php } ?>

      @elseif(Auth::user()->user_type == "Command Center Account")
        <!-- Aid Workers -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-users"></i>
            <span>Aid Workers</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="/viewAid">View All</a>
            <a class="dropdown-item" href="/manageAid">Manpower Requests</a>
            <a class="dropdown-item" href="/addAid">New Aid Worker</a>
          </div>
        </li>

        <!-- Relief Ops -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-parachute-box"></i>
            <span>Relief Aid</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <!-- Removed New Operation from here -->
              <a class="dropdown-item" href="/viewAllRelief">View Relief Ops</a>
              <a class="dropdown-item" href="/viewDonations">Donations</a>
              <a class="dropdown-item" href="/cmdViewItemRequests">Item Requests</a>
              <a class="dropdown-item" href="/viewInventory">Current Inventory</a>
            </div>
        </li>

        <!-- Evacuation -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-exclamation-circle"></i>
            <span>Evacuation</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="/viewCenters">Evac Centers</a>
            <a class="dropdown-item" href="/addCenter">New Center</a>
            <a class="dropdown-item" href="/chat">Chat</a>
            <a class="dropdown-item" href="/evacHistory">History</a>
            <a class="dropdown-item" href="/writesms">Send Custom SMS</a>
          </div>
        </li>

        <li  class="nav-item ">
          <a class="nav-link" href="/reactivate">
          <i class="fas fa-home"></i>
          <span>Account List</span>
          </a>
        </li>
        
        @elseif(Auth::user()->user_type == "Evacuation Center Account")
        <?php 
          $evac = App\Evacuation::select('status')->where('status','Ongoing')
                                  ->orderBy('id','desc')
                                  ->first();
          if($evac['status'] == "Ongoing"){
        ?>
                                                           
        <!-- Aid Workers -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-users"></i>
            <span>Aid Workers</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="/viewAidHere">View All Aidworkers</a> <!-- kamandag -->
            <a class="dropdown-item" href="/incomingAid">Incoming Aid</a> <!-- kamandag -->
            <a class="dropdown-item" href="/viewRequest">Current Requests</a> <!-- kamandag -->
         </div>
        </li>

        <!-- Relief Ops -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-boxes"></i>
            <span>Inventory</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item" href="/viewInventory">View Inventory</a>
              <a class="dropdown-item" href="/viewAllRelief">Send Relief Aid</a>
              <a class="dropdown-item" href="/incomingRelief">Incoming Relief</a>
              <!--<a class="dropdown-item" href="/viewDonations">Donations</a>-->
              <a class="dropdown-item" href="/requestItems">Requests</a>
            </div>
        </li>

        <!-- Evacuation -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-exclamation"></i>
              <span>Evacuation</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="/evacuateHere">Evacuate</a>
            <a class="dropdown-item" href="/chat">Chat</a>
          </div>
        </li>

        <li  class="nav-item ">
          <a class="nav-link" href="/writesms">
          <i class="fas fa-envelope"></i>
          <span>Send SMS</span>
          </a>
        </li>
    <?php } ?>
      @endif
  </ul>   

  <div id="content-wrapper">

    <div class="container-fluid">

      