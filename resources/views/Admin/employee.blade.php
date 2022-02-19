@extends('layout')

@section('title','Admin-Employee Details')

@section('content')
{{-- main content --}}
<section class="no-padding-top">
    <div class="container-fluid">
      {{-- <div class="row d-flex">
        <!-- Add Employee-->
        <div class="col-3">
          <div class="block">
            <div class="title"><strong>Add New Employee</strong></div>
            <div class="block-body text-center">
              <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary"> Click here  </button>
              </div>
            </div>
          </div> --}}
    <!-- Add Intern-->
        {{-- <div class="col-3">
          <div class="block">
            <div class="title"><strong>Add New Intern</strong></div>
            <div class="block-body text-center">
              <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary"> Click here  </button>
              </div>
            </div>
          </div> --}}
  <!-- Add Contractual Employee-->
        {{-- <div class="col-3">
          <div class="block">
            <div class="title"><strong>Add New Freelancer</strong></div>
            <div class="block-body text-center">
              <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary"> Click here  </button>
              </div>
            </div>
          </div>
        </div> --}}

 <!-- Form Elements -->
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Employee Table</strong></div>
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="empTable">
                <thead>
                  <tr>
                    <th>Sl. No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Photos</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>HR Table</strong></div>
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="hrTable">
                <thead>
                  <tr>
                    <th>Sl. No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Photos</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- modal --}}
            <!-- Add Employee Modal-->
            <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <strong id="exampleModalLabel" class="modal-title" >New Employee Details</strong >
                  <button  type="button" data-dismiss="modal"  aria-label="Close" class="close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form name="myFormEmployee" id="myFormEmployee" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" placeholder="Enter Employee Name"  class="form-control" name="username" id="username"/>
                      <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
                      <input type="hidden" class="form-control" id="hidId" name="hidId" aria-describedby="id">                            
                    </div>
                    <span id="usererr" class="text-danger"></span>

                    <div class="form-group">
                      <label>Choose Use Role</label>
                      <select class="form-control" id="roles" name="roles" required>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>User Id</label>
                      <input type="text" placeholder="User id" class="form-control" name="userid" id="userid" readonly/>
                      <span id="useriderr" class="text-danger"></span>
                    </div>

                    <label>Choose Position</label>
                    <div class="form-group" id="positionChoosen">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="position" id="inlineRadio1" value="Frontend" required>
                        <label class="form-check-label" for="inlineRadio1">Frontend</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Backend">
                        <label class="form-check-label" for="inlineRadio2">Backend</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Full Stack">
                        <label class="form-check-label" for="inlineRadio3">Full Stack</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" placeholder="Email Address" class="form-control" id="email" name="email"/>
                      <span id="mailerr" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                      <label>Photo</label>
                      <input type="file" placeholder="Upload Photo" class="form-control" id="photo" name="photo"/>
                    </div>

                    <div class="form-group">
                      <label>D.O.B</label>
                      <input type="date" placeholder="Enter dob" class="form-control" id="dob" name="dob"  required/>
                      <span id="doberr" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password"  placeholder="Password" class="form-control" id="password" name="password" />
                      <span id="passerr" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Salary</label>
                      <input  type="number" min="1000" max="50000" placeholder="Salary" class="form-control" id="salary" name="salary" required/>
                      <span id="salerr" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="number" placeholder="Phone Number" class="form-control" id="phone" name="phone" />
                      <span id="phonerr" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" placeholder="Enter Address" class="form-control" id="address" name="address"/>
                      <span id="adderr" class="text-danger"></span>
                    </div>
                    
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" id="addEmp">Submit</button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button  type="button" data-dismiss="modal" class="btn btn-secondary">Close </button>
                </div>
              </div>
            </div>
          </div>
{{-- .add employee --}}

 <!-- edit Employee Modal-->
 <div id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <strong id="exampleModalLabel" class="modal-title" >Edit Employee Details</strong >
        <button  type="button" data-dismiss="modal"  aria-label="Close" class="close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" name="myFormEmployeeEdit" id="myFormEmployeeEdit">
          <div class="form-group">
            <label>User Id</label>
            <input type="text" placeholder="User id" class="form-control" name="euserid" id="euserid" />           
            <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" class="form-control" id="hidId" name="hidId" aria-describedby="id">                            
          </div>
          <span id="useriderr" class="text-danger"></span>
          <div class="form-group">
            <label>Choose Use Role</label>
            <select class="form-control" id="roles1" name="roles1" required>
            </select>
          </div>
          <label id="hiddenlabel">Choose Position</label>
            <div class="form-group" id="positionChoosen">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="eposition" id="inlineRadio1" value="Frontend" required>
                <label class="form-check-label" for="inlineRadio1">Frontend</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="eposition" id="inlineRadio2" value="Backend">
                <label class="form-check-label" for="inlineRadio2">Backend</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="eposition" id="inlineRadio3" value="Full Stack">
                <label class="form-check-label" for="inlineRadio3">Full Stack</label>
              </div>
            </div>
          <div class="form-group">
            <label>Salary</label>
            <input  type="number" min="1000" max="50000" placeholder="Salary" class="form-control" id="esalary" name="esalary" />
            <span id="salerr" class="text-danger"></span>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="editEmp">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button  type="button" data-dismiss="modal" class="btn btn-secondary">Close </button>
      </div>
    </div>
  </div>
</div>
{{-- .add employee --}}
{{-- view prof show more --}}
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">User Profile Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card" id="profile">
                      {{-- <img class="mt-2" id="profimg" style="border-radius:50%; display: block;
                      margin-left: auto;margin-right: auto;" src="public/img/avatar-9.jpg" class="card-img-top" height="15%" width="10%" alt="prof"><div style="height: 15px; width:15px; border-radius:50%;background-color:green; color:green;border:rgb(10, 243, 10);margin-left: auto;margin-right: auto; margin-top:-8px; position: relative;"></div> --}}
            
                      {{-- <div class="popup" style="height: 15px; width:15px;margin-left: auto;margin-right: auto; position: relative; display:flex; justify-content:space-between;padding:10px;"> <i class="fa fa-camera"></i> <i class="fa fa-trash"></i> </div> --}}
                      {{-- <div class="card-body">
                        <h5 class="card-title text-center">{{session('display_name')}}</h5>
                        <p class="card-text text-center">
                          <b>Employee Code:</b> <span>{{session('emp_code')}}</span> <br>
                          <b>Salary:</b> <span>12000</span> <br>
                          <b>Address:</b> <span>RKL</span> <br>
                          <b>Date of Birth:</b> <span>19/01/1998</span> <br>
                          <b>Assigned Project:</b> <span>EMS</span> <br>
                        </p>                      
                      </div> --}}
                    </div>
                  </div>         
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
{{-- .main content --}}
@endsection

@push('scripts')

<script src="resources\views\js\employee_admin.js"></script>

@endpush