  @extends('layout')

  @section('title','Profile')

  @section('content')  
  <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card"  id="profile">
            </div>
            <span class="text-danger text-center">{{$profup ?? ""}}</span>
            <div class="row">
              <div class="col-md-6 mb-0"><p>Change Password.. <a href="#" data-toggle="modal" data-target="#passmodal">Click here</a></p>   </div>
              <div class="col-md-6 text-right"><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#upempmodal">Update Details</button></div>
            </div>   
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
            <form  method="post" action="updateEmployeeInfoManual" id="updateEmpInfo" enctype="multipart/form-data">
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
              <button type="submit" class="btn btn-primary fa fa-pencil">Update</button>
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
            <form action="resetpasswithlogin" method="POST" onsubmit="return passresetLogin()">
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
              <button type="submit" class="btn btn-primary fa fa-pencil">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  @endsection

@push('scripts')
<script src="resources\views\js\employee.js"></script>
<script>
  function passresetLogin(){
    var old = document.getElementById('opass').value;
    var newp = document.getElementById('npass').value;

    // console.log(newp)
    // console.log(old)

    if(old == ""){
      document.getElementById('olderr').innerHTML = "Please fill the password";    
      return false;
  }
  if((old.length <= 5)||(old.length >30))
  {
      document.getElementById('olderr').innerHTML = "Password must contain 6 to 30 character";    
      return false;
  }
  if(newp == ""){
      document.getElementById('newerr').innerHTML = "Please fill the new password";    
      return false;
  }
  if((newp.length <= 5)||(newp.length >30))
  {
      document.getElementById('newerr').innerHTML = "New Password must contain 6 to 30 character";    
      return false;
  }
   return true;
  }

  $(document).ready(function(){
    $('#pass-clk').click(function(){
      $('#eye-icon').toggleClass('fa-eye-slash');
      var input = $('#opass');
      if(input.attr('type') === "password"){
        input.attr('type','text');
      }else{
        input.attr('type','password');
      }
    });

    $('#cpass-clk').click(function(){
      $('#c-eye-icon').toggleClass('fa-eye-slash');
      var input1 = $('#npass');
      if(input1.attr('type') === "password"){
        input1.attr('type','text');
      }else{
        input1.attr('type','password');
      }
    });
  });

</script>

@endpush
  
