@extends('layout')

@section('title','Profile')

@section('content')  
<section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card"  id="profile">
          </div>
          <div class="row">
            <div class="col-12 alert alert-success" id="resetSuccess"></div>
          </div> 
          <div class="row">
            <div class="col-md-6 mb-0"><p>Change Password.. <a href="#" data-toggle="modal" data-target="#passmodal">Click here</a></p>   </div>
            <div class="col-md-6 text-right"><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#upempmodal">Update Details</button></div>
          </div>   
        </div>  
          <div class="col-6">
            <label for="sign">Upload Digital Signature</label>
            <form action="uploadHRDigSign" id="upload-dig-sign" enctype="multipart/form-data" method="post">
              @csrf
              <div class="form-group">
                <input type="file" class="form-control" id="sign" name="sign" required>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm" value="Upload" id="signupload_btn" name="signupload_btn">
              </div>
            </form>
            @if (\Session::has('message'))
            <div class="alert alert-success">
               <p> {!! \Session::get('message') !!}</p>
            </div>
          @endif
          </div>
    </div>
  </section>
  {{-- update emp personal details --}}
  <div class="modal fade" id="upempmodal" tabindex="-1" role="dialog" aria-labelledby="upempmodalexmpl" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="upempmodalexmpl">Update Personal Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="updateEmpInfo" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="photo">Profile photo:</label>
              <input type="file" class="form-control"  name="photo" id="photo" aria-describedby="img" placeholder="Enter profile pic" required>
            </div>
            <div class="form-group">
              <label for="dob">Date of birth:</label>
              <input type="date" class="form-control" name="dob" id="dob" aria-describedby="date" placeholder="Enter date" required>
            </div>
            <label for="address">Address:</label>
            <div class="form-group">
              <textarea name="address" id="address" cols="40" rows="5" placeholder="update address here.."></textarea>
            </div>
            <button type="submit" class="btn btn-primary fa fa-pencil" id="updateEmpInfoBtn">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
{{-- update password --}}
  <div class="modal fade" id="passmodal" tabindex="-1" role="dialog" aria-labelledby="passmodalex" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="passmodalex">Reset Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="HRresetpasswithlogin" onsubmit="return passresetLogin()">
            @csrf
            <div class="form-group input-group">
                  <input type="password" class="form-control" id="opass" name="opass" aria-describedby="password" placeholder="Enter current password">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <a href="#" id="pass-clk" class="text-light"><i class="fa fa-eye" area-hidden="true" id="eye-icon"></i></a>
                    </div>
                  </div>
              </div>
              <span id="olderr"></span>
              <div class="form-group input-group">
                  <input type="password" class="form-control" id="npass" name="npass" aria-describedby="password" placeholder="Enter new password">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <a href="#" id="cpass-clk" class="text-light"><i class="fa fa-eye" area-hidden="true" id="c-eye-icon"></i></a>
                    </div>
                  </div>
              </div>

              <span id="newerr"></span>
              <br>
              <span id="err"></span> <br>
            <button type="submit" class="btn btn-primary fa fa-pencil" id="passwordReset">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@push('scripts')
<script src="resources\views\js\hr.js"></script>

@endpush

