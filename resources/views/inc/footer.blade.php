
          <!-- Sticky Footer -->
          <footer class="sticky-footer">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright © BESFREND Project 2018</span>
              </div>
            </div>
          </footer>

          </div>
          <!-- /.content-wrapper -->

          </div>
          <!-- /#wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Help Modal-->
      <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-lg border-info">
            <div class="modal-header modal-lg text-white bg-info">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i> BESFREND - Help Center</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body modal-lg">
              <h5 class="text-center">First time user? Learn how to navigate through the BESFREND application!</h5>
              <p class="text-center">Below is a list of guides on how to do this and that.</p>
              <div id="accordion">
                  <div class="card border-primary">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Adding a New Household Member
                        </button>
                      </h5>
                    </div>
                
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        To add a new household member into the household account, 
                        simple click/tap <strong><i class="fas fa-user-plus"></i> Add New Member</strong> on the sidebar.
                        A registration form will appear and input the appropriate information
                        of your fellow household member and click/tap <button class="btn btn-sm btn-outline-success">Submit</button>.
                      </div>
                    </div>
                  </div>

                  <div class="card border-primary">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Updating a Household Member's Information
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        Click/tap <strong><i class="fas fa-users"></i> Household Members</strong> on the
                        sidebar to access the list of individuals that belong to the same household.
                        Once in there, find the person you want to change and click/tap 
                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button> on the <strong>action</strong> column.
                        <br><br>
                        After clicking/tapping <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>, a set of input forms will appear with the current data
                        already inserted by default. You can change the data of any of the forms, and click/tap
                        <button class="btn btn-sm btn-outline-success">Update</button> to update the member's information.
                      </div>
                    </div>
                  </div>

                  <div class="card border-primary">
                    <div class="card-header" id="headingThree">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Viewing a Household Member's Info Including Medical Record
                        </button>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body">
                          Click/tap <strong><i class="fas fa-users"></i> Household Members</strong> on the
                          sidebar to access the list of individuals that belong to the same household.
                          Once in there, find the person you want to view and click/tap the 
                          <button class="btn btn-sm btn-outline-success"><i class="far fa-eye"></i></button> on the <strong>action</strong> column.
                          <br><br>
                          The <button class="btn btn-sm btn-outline-success"><i class="far fa-eye"></i></button> will redirect you
                          to a page that displays the <strong>selected member's information</strong>, which includes the <strong>medical history</strong>.
                      </div>
                    </div>
                  </div>

                  <div class="card border-primary">
                    <div class="card-header" id="headingFour">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                          Adding a New Medical Condition in the Record
                        </button>
                      </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                      <div class="card-body">
                          When viewing the <strong>household member's information</strong>, the medical history 
                          is located below. Click/tap <button class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i> Add Medical Record</button>.
                          <br><br>
                          A set of <strong>input forms</strong> will appear after clicking/tapping 
                          <button class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i> Add Medical Record</button>. You may input
                          the condition, its severity, and the medication needed. After inputting the appropriate information
                          in the forms, click/tap <button class="btn btn-sm btn-outline-success">Add Medical Condition</button> to submit.
                      </div>
                    </div>
                  </div>

                  <div class="card border-primary">
                    <div class="card-header" id="headingFive">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                          Updating a Medical Condition
                        </button>
                      </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                      <div class="card-body">
                          When viewing the <strong>household member's information</strong>, the medical history 
                          is located below. Find the medical condition you want to udpate and 
                          click/tap <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                          on the <strong>action</strong> column to show a set of input forms with the 
                          current information already inputted by default.
                          <br><br>
                          Change any of the data in the input forms, and click/tap <button class="btn btn-sm btn-outline-success">Update Medical Condition</button>
                          to submit the final changes of that medical condition.
                      </div>
                    </div>
                  </div>

                </div>
            </div>
            <div class="modal-footer modal-lg">
              <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Close Help Center</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Bootstrap core JavaScript-->
     
     <script src="{{ asset("/js/bootstrap.bundle.min.js") }}"></script>

     
 
     <!-- Page level plugin JavaScript-->
     <script src="{{ asset("/js/Chart.js") }}"></script>
     <script src="{{ asset("/js/jquery.dataTables.js") }}"></script>
     <script src="{{ asset("/js/dataTables.bootstrap4.js") }}"></script>
 
     <!-- Custom scripts for all pages-->
     <script src="{{ asset("/js/sb-admin.js") }}"></script>

      <!-- Demo scripts for this page-->
     <script src="{{ asset("/js/datatables-demo.js") }}"></script>
 
