@extends('layout')

@section('title','Manager Details')

@section('content')
{{-- main content --}}
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row d-flex">
        <!-- Add Employee-->
        <div class="col-3">
          <div class="block">
            <div class="title"><strong>New Manager</strong></div>
            <div class="block-body">
              <button type="button" data-toggle="modal" data-target="#managerModal" class="btn btn-primary fa fa-user-plus"> Add</button>
              </div>
            </div>
          </div>
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Active Manager Table</strong></div>
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="managerTable">
                <thead>
                  <tr>
                    <th>Sl. No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Photos</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Phone</th>
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
            <div class="title"><strong>Disabled Manager Table</strong></div>
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="dismanagerTable">
                <thead>
                  <tr>
                    <th>Sl. No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Photos</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Enable</th>
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
            <div id="managerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <strong id="exampleModalLabel" class="modal-title" >New Managers Details</strong >
                  <button  type="button" data-dismiss="modal"  aria-label="Close" class="close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form name="formManager" id="formManager" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" placeholder="Enter Employee Name"  class="form-control" name="username" id="username"/>
                      <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
                      <input type="hidden" class="form-control" id="hidId" name="hidId" aria-describedby="id">                            
                    </div>
                    <span id="usererr" class="text-danger"></span>
                    <div class="form-group">
                      <label>User Id</label>
                      <input type="text" placeholder="User id" class="form-control" name="userid" id="userid" readonly/>
                      <span id="useriderr" class="text-danger"></span>
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

                    {{-- <div class="form-group">
                      <label>Password</label>
                      <input type="text"  placeholder="Password" class="form-control" id="password" name="password"/>
                      <span id="passerr" class="text-danger"></span>
                    </div> --}}

                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="number" placeholder="Phone Number" class="form-control" id="phone" name="phone" />
                      <span id="phonerr" class="text-danger"></span>
                    </div>
                   
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" id="addManager">Submit</button>
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
  </div>
{{-- .main content --}}
@endsection

@push('scripts')

<script src="resources\views\js\management.js"></script>

@endpush